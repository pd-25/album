<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\SupportTicketCategory;
use App\Models\SupportTicketMessages;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $userId = auth()->user()->id;
        $category = SupportTicketCategory::where('status', 1)->get();
        // $data['supporticket'] = SupportTicket::select('id', 'subject', 'status', DB::raw('(SELECT COUNT(*) FROM support_ticket_messages LEFT JOIN support_tickets ON support_ticket_messages.support_ticektId = support_tickets.id  WHERE support_ticket_messages.status = 1 And support_ticket_messages.admin = 1) as messageCount'))->orderBy('id', 'desc')->get();
        $supporticket =array();
        $supportic = SupportTicket::where('userId', $userId )->orderBy('id', 'desc')->get();
        foreach ($supportic as $key => $value) 
        {
            $inertialArr = array(
                'id'=>$value->id,
                'subject' => $value->subject,
                'status' => $value->status,
                'messageCount' =>  SupportTicketMessages::where('support_ticektId', $value->id)->where('status', 1)->where('admin', 1)->count()
            );
            array_push($supporticket, $inertialArr);
        }
        $supporticket = json_encode($supporticket, true);
        return view('user.support_ticket.support_ticket', compact('supporticket', 'category'));
    }

    public function showmessage($id)
    {
        $data['supportic'] = SupportTicket::with('messageDetails', 'userDetails')->find($id);
        $data['category'] = SupportTicketCategory::where('status', 1)->get();
        $data['message'] = SupportTicketMessages::where('support_ticektId', $data['supportic']->id)->get();

        $update = SupportTicketMessages::where('support_ticektId', $id)->where('admin', 1)->get();
        foreach ($update as $key => $value) {
            $value->status = 0;
            $value->save();
        }
        return view('user.support_ticket.messages', $data);
    }

    public function SendMessage(Request $request)
    {
        $request->validate([
            'message'=>'required',
            'supportticketid'=>'required'
        ]);

        $supportTicketMessages = new SupportTicketMessages;
        $supportTicketMessages->support_ticektId = $request->supportticketid;
        $supportTicketMessages->messages = $request->message;
        $supportTicketMessages->user = 1;
        $supportTicketMessages->admin = 0;
        $supportTicketMessages->status = 2;
        $supportTicketMessages->save();
        return back()->with("succes",'Message send');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $category = SupportTicketCategory::where('status', 1)->get();
        $supporticket =array();
        $supportic = SupportTicket::where('status', 1)->orderBy('id', 'desc')->get();
        
        foreach ($supportic as $key => $value) 
        {
            $userName = User::where('id', $value->userId)->first();
            $inertialArr = array(
                'id'=>$value->id,
                'username'=> $userName->name,
                'subject' => $value->subject,
                'status' => $value->status,
                'messageCount' =>  SupportTicketMessages::where('support_ticektId', $value->id)->where('status', 2)->where('user', 1)->count()
            );
            array_push($supporticket, $inertialArr);
        }
        $supporticket = json_encode($supporticket, true);
        return view('admin.support_ticket.support_ticket', compact('supporticket'));
    }

    public function adminmessageshow($id)
    {
        $data['supportic'] = SupportTicket::with('messageDetails', 'userDetails')->find($id);
        $data['category'] = SupportTicketCategory::where('status', 1)->get();
        $data['message'] = SupportTicketMessages::where('support_ticektId', $data['supportic']->id)->get();

        $update = SupportTicketMessages::where('support_ticektId', $id)->where('user', 1)->get();
        foreach ($update as $key => $value) {
            $value->status = 0;
            $value->save();
        }
        return view('admin.support_ticket.messages', $data);
    }

    public function AdminSendMessage(Request $request)
    {
        $request->validate([
            'message'=>'required',
            'supportticketid'=>'required'
        ]);

        $supportTicketMessages = new SupportTicketMessages;
        $supportTicketMessages->support_ticektId = $request->supportticketid;
        $supportTicketMessages->messages = $request->message;
        $supportTicketMessages->user = 0;
        $supportTicketMessages->admin = 1;
        $supportTicketMessages->status = 1;
        $supportTicketMessages->save();
        return back()->with("succes",'Message send');
    }

    public function status(Request $request)
    {
        $asset = SupportTicket::find($request->id);
        $asset->status = $request->status;
        if($asset->save()){
            return response()->json('success');
        }else{
            return  response()->json('error');
        }
    }

    public function tickethistory()
    {
        // $category = SupportTicketCategory::where('status', 1)->get();
        $supporticket =array();
        $supportic = SupportTicket::where('status', 0)->orderBy('id', 'desc')->get();
        
        foreach ($supportic as $key => $value) 
        {
            $userName = User::where('id', $value->userId)->first();
            $inertialArr = array(
                'id'=>$value->id,
                'username'=> $userName->name,
                'subject' => $value->subject,
                'status' => $value->status,
                'messageCount' =>  SupportTicketMessages::where('support_ticektId', $value->id)->where('status', 2)->where('user', 1)->count()
            );
            array_push($supporticket, $inertialArr);
        }
        $supporticket = json_encode($supporticket, true);
        return view('admin.support_ticket.ticket_history', compact('supporticket'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject'=>'required',
            'categoryId'=>'required',
            'description'=>'required',
        ]);

        $supportTicket = new SupportTicket;
        $supportTicket->userId	= auth()->user()->id;
        $supportTicket->subject = $request->subject;
        $supportTicket->categoryId = $request->categoryId;
        $supportTicket->description = $request->description;
        $supportTicket->status = 1;

        if ($request->hasFile('attachments')) {
            $image_path = date('Y-m-d-H_i_s').'_' .$request->file('attachments')->getClientOriginalName();
            $request->file('attachments')->storeAs('support_ticket', $image_path,['disk' => 'public']);
            $supportTicket->attachments = $image_path;
        }
        if($supportTicket->save())
        {
            return back()->with('success', 'Added successfully!');
        }else{
            return back()->with('errorMessage', 'Opps! Something went wrong');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SupportTicket $supportTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupportTicket $supportTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupportTicket $supportTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupportTicket $supportTicket)
    {
        //
    }


    public function categoryindex(SupportTicketCategory $supportTicketCategory)
    {
        $supportTicketCategory =  SupportTicketCategory::orderBy('category_name', 'ASC')->get(); 
        return view('admin.support_ticket.supportCategory', compact('supportTicketCategory'));
    }

    public function categorystore(Request $request)
    {
        $request->validate([
            'category_name'=>'required',
            'status'=>'required',
        ]);
        if($request->id){
            $supportTicketCategory = SupportTicketCategory::find($request->id); 
            $supportTicketCategory->category_name = $request->category_name;
            $supportTicketCategory->status = $request->status;
        }else{
            $supportTicketCategory = new SupportTicketCategory; 
            $supportTicketCategory->category_name = $request->category_name;
            $supportTicketCategory->status = $request->status;
        }

        if($supportTicketCategory->save()){
            return back()->with('success', 'Added/update successfully!');
        }else{
            return back()->with('error', 'Something went wrong');
        }
    }


}
