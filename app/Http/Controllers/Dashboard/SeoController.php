<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeoRequest;
use App\Services\Dashboard\Seo\ISeoService;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    protected $iSeoService;
    public function __construct(ISeoService $iSeoService)
    {
        $this->iSeoService = $iSeoService;
  }
    public function index() {
        $seo = $this->iSeoService->getSeoPageName();
        return view('dashboard.seo.index' , compact('seo'));
    }

    public function edit($id){
        $seo = $this->iSeoService->getSeoByid($id);
        return view('dashboard.seo.update' , compact('seo'));
    }

    public function update(SeoRequest $request , $id) {

         $seo = $this->iSeoService->updateSeo($request , $id);
        if(!$seo){
            return back()->with('error', __('dashboard.error_msg'));
        }
        cache()->forget('global_seo');
        return redirect()->route('dashboard.seo.index')->with('success', __('dashboard.success_msg'));
    }
}
