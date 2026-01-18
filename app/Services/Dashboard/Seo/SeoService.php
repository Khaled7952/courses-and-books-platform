<?php
namespace App\Services\Dashboard\Seo;

use App\Repositories\Dashboard\Seo\ISeoRepository;

class SeoService implements ISeoService{


    protected $ISeoRepository;

    public function __construct(ISeoRepository $ISeoRepository)
    {
        $this->ISeoRepository = $ISeoRepository;
    }

    public function updateSeo($request , $id){

        $seo = $this->getSeoByid($id);
        $page_name = $seo->page_name;
        return $this->ISeoRepository->updateSeo($request , $seo , $page_name);
    }

    public function getSeoByid($id){

        return $this->ISeoRepository->getSeoByid($id);
    }
    public function getSeoPageName(){

       return $this->ISeoRepository->getSeoPageName();
    }


    }
