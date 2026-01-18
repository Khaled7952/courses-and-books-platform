<?php
namespace App\Repositories\Dashboard\Seo;


interface ISeoRepository{

public function updateSeo($request  , $seo , $page_name);
public function getSeoByid($id);
public function getSeoPageName();

}
