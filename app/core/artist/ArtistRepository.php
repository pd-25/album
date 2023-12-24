<?php

namespace App\core\artist;

use App\Models\ArtistNameLocalization;
use App\Models\TimeTable;
use App\Models\User;
use App\Models\Label;
use App\Models\Asset;
use App\Models\Website;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ArtistRepository implements ArtistInterface
{
    public function getAllArtist()
    {
        return User::where('type', 'artist')->orderBy('id', 'DESC')->get();
    }

    public function getAllUser()
    {
        return User::where('type', 'user')->orderBy('id', 'DESC')->get();
    }

    public function userWiseArtist($id){
        return User::where('type', 'artist')->where('user_id', $id)->orderBy('id', 'DESC')->get(); 
    }

    

    public function storeArtistData($data, $websiteData, $localizationData)
    {
        // dd($localizationData);
        if (isset($data['image']) && $data['image'] != null) {
            $content_db = time() . rand(0000, 9999) . "." . $data['image']->getClientOriginalExtension();
            $data['image']->storeAs("public/ArtistImage", $content_db);
            $data['image'] = $content_db;
        }

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        $timeData['user_id'] = $user->id;
        if (isset($websiteData['webSiteName'])) {
            foreach ($websiteData['webSiteName'] as $k => $web) {
                Website::create([

                    'user_or_label_id' => $timeData['user_id'],
                    'type' => 'artist',
                    'title' =>  $web,
                    'url' => $websiteData['url'][$k]
                ]);
            }
        }

        if (isset($localizationData['country'])) {
            foreach ($localizationData['country'] as $k => $lok) {
                ArtistNameLocalization::create([
                    'artist_id' => $timeData['user_id'],
                    'language' =>  $lok,
                    'name' => $localizationData['artist_name'][$k]
                ]);
            }
        }
        return true;
    }

    public function getSingleArtist($id)
    {
        $find =  User::with('websiteArtists', 'artistLocal')->where('id', $id)->first();
        if ($find) {
            return $find;
        } else {
            return 'Not Found';
        }
    }

    public function getSingleUser($id){
        $find =  User::where('id', $id)->first();
        if ($find) {
            return $find;
        } else {
            return 'Not Found';
        }
    }

    public function updateArtist($data, $id, $websiteData, $localizationData)
    {
        $find =  User::where('id', $id)->first();
        if ($find) {
            if (isset($data['image']) && $data['image'] != null) {
                File::delete(public_path("storage/ArtistImage/" . $find->image));
                $content_db = time() . rand(0000, 9999) . "." . $data['image']->getClientOriginalExtension();
                $data['image']->storeAs("public/ArtistImage", $content_db);
                $data['image'] = $content_db;
            }

            if (isset($websiteData['webSiteName'])) {
                Website::where('user_or_label_id', $id)->delete();
                $webData = [];
                // 'user_or_label_id' => $timeData['user_id'],
                foreach ($websiteData['webSiteName'] as $k => $web) {
                    
                    $webData[] =[
                        'user_or_label_id' => $id,
                        'type' => 'artist',
                        'title' =>  $web,
                        'url' => $websiteData['url'][$k]
                    ];
                }
              foreach ($webData as $value) {
                Website::create($value);
              }
               
            }

            if (isset($localizationData['country'])) {
                ArtistNameLocalization::where('artist_id', $id)->delete();
                $localData = [];
                foreach ($localizationData['country'] as $k => $lok) {
                    $localData[] =[
                        'artist_id' => $id,
                        'language' =>  $lok,
                        'name' => $localizationData['artist_name'][$k]
                    ];
                }
                foreach($localData as $lData){
                    ArtistNameLocalization::create($lData);
                }
            }
            
            return $find->update($data);
        } else {
            return 'No data';
        }
    }


    public function deleteArtist($id)
    {
        $find =  User::where('id', $id)->first();
        if ($find) {
            if($find->type == 'artist'){
                foreach ($find->websiteArtists as $art) {
                    $art->delete();
                }

                foreach ($find->artistLocal as $local) {
                    $local->delete();
                }
            }
            

            return $find->delete();
        }
        return 'not found';
    }

    public function Dashboard($userid)
    {
        $dashboard['reelase'] = Asset::count();
        $dashboard['artist'] = User::where('type', 'artist')->count();
        if($userid){
            $dashboard['userreelase'] = Asset::where('user_id', $userid)->count();
        }
        $dashboard['label'] = Label::count();
        return $dashboard;
    }

}
