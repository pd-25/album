<?php
namespace App\core\artist;

interface ArtistInterface {
    public function getAllArtist();
    public function getAllUser();
    public function storeArtistData($data, $websiteData, $localizationData);
    public function getSingleArtist($id);
    public function getSingleUser($id);
    public function updateArtist($data,$id,$websiteData, $localizationData);
    public function deleteArtist($id);
    public function userWiseArtist($id);
    public function Dashboard();
}