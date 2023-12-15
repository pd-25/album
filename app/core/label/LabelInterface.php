<?php
namespace App\core\label;

interface LabelInterface {
    public function storeLabel($labelData, $genreData, $websiteData);
    public function getAllLabel();
    public function getSingleLabel($id);
    public function updateLabel($labelData, $id, $genreData, $websiteData);
    public function deleteLabel($id);
    public function userWiseLabel($id);
}