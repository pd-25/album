<?php
namespace App\core\asset;

interface AssetInterface {
    public function storeAsset($labelData, $genreData, $websiteData);
    // public function getAllLabel();
    // public function getSingleLabel($id);
    // public function updateLabel($labelData, $id, $genreData, $websiteData);
    // public function deleteLabel($id);
}