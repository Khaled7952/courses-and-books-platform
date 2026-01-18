<?php
namespace App\Services\Dashboard\Seo;


interface ISeoService{

    public function updateSeo($request , $id);
    public function getSeoByid($id);
    public function getSeoPageName();


    }
