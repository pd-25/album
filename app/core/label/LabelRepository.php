<?php

namespace App\core\label;

use App\Models\Genres;
use App\Models\Label;
use App\Models\Website;
use Illuminate\Support\Facades\File;

class LabelRepository implements LabelInterface
{
    public function storeLabel($labelData, $genreData, $websiteData)
    {
        if (isset($labelData['image']) && $labelData['image'] != null) {
            $content_db = time() . rand(0000, 9999) . "." . $labelData['image']->getClientOriginalExtension();
            $labelData['image']->storeAs("public/LabelImage", $content_db);
            $labelData['image'] = $content_db;
        }

        $label = Label::create($labelData);
        if (isset($websiteData['webSiteName'])) {
            foreach ($websiteData['webSiteName'] as $k => $web) {
                Website::create([

                    'user_or_label_id' => $label->id,
                    'type' => 'label',
                    'title' =>  $web,
                    'url' => $websiteData['url'][$k]
                ]);
            }
        }

        if (isset($genreData['gener_id'])) {
            foreach ($genreData['gener_id'] as  $g) {

                Genres::create([
                    'label_id' => $label->id,
                    'genre_id' => $g
                ]);
            }
        }



        return true;
    }

    public function getAllLabel()
    {
        return Label::orderBy('id', 'DESC')->get();
    }

    public function getSingleLabel($id)
    {
        return Label::with('websitelabels')->where('id', $id)->first();
    }

    public function updateLabel($labelData, $id, $genreData, $websiteData)
    {
        $find =  Label::where('id', $id)->first();
        if ($find) {
            if (isset($labelData['image']) && $labelData['image'] != null) {
                File::delete(public_path("storage/LabelImage/" . $find->image));
                $content_db = time() . rand(0000, 9999) . "." . $labelData['image']->getClientOriginalExtension();
                $labelData['image']->storeAs("public/LabelImage", $content_db);
                $labelData['image'] = $content_db;
            }

            if (isset($websiteData['webSiteName'])) {
                Website::where('user_or_label_id', $id)->where('type', 'label')->delete();
                $webData = [];
                // 'user_or_label_id' => $timeData['user_id'],
                foreach ($websiteData['webSiteName'] as $k => $web) {

                    $webData[] = [
                        'user_or_label_id' => $id,
                        'type' => 'label',
                        'title' =>  $web,
                        'url' => $websiteData['url'][$k]
                    ];
                }
                foreach ($webData as $value) {
                    Website::create($value);
                }
            }


            if (isset($genreData['gener_id'])) {
                Genres::where('label_id', $id)->delete();
                foreach ($genreData['gener_id'] as  $g) {

                    Genres::create([
                        'label_id' => $id,
                        'genre_id' => $g
                    ]);
                }
            }


            return $find->update($labelData);
        } else {
            return 'No data';
        }
    }

    public function deleteLabel($id)
    {
        $find =  Label::where('id', $id)->first();
        if ($find) {
            foreach ($find->websitelabels as $art) {
                $art->delete();
            }
            foreach ($find->genress as $local) {
                $local->delete();
            }
            return $find->delete();
        }
        return 'not found';
    }
}
