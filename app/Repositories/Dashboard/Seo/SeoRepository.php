<?php
namespace App\Repositories\Dashboard\Seo;

use App\Models\Seo;

class SeoRepository implements ISeoRepository{

public function updateSeo($request  , $seo , $page_name){
    $seo->update([
        'page_name' => $page_name,
        'meta_description' => [
            'ar' => $request->meta_description_ar,
            'en' => $request->meta_description_en,
        ],
        'meta_keywords' => [
            'ar' => $request->meta_keywords_ar,
            'en' => $request->meta_keywords_en,
        ],
        'meta_title' => [
            'ar' => $request->meta_title_ar,
            'en' => $request->meta_title_en,
        ],
    ]);
    return $seo;
}

public function getSeoByid($id){
    $seo = Seo::findOrFail($id);
    return $seo;
}

public function getSeoPageName(){

    return Seo::select('id' , 'page_name')->get();
}

}
