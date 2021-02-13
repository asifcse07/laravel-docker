<?php

namespace App\Repositories\Interfaces;


interface AdRepositoryInterface
{
    public function getAllAdWithImages($page, $limit);
    public function getAllAds();
    public function getTotalAds();
    public function getAdById($ad_id);
    public function getAdByIdWithOutImage($ad_id);
}
