<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormFeildsRequest;
use App\Services\Website\Form\IFormService;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FormController extends Controller
{
    protected $iFormService;


    public function __construct(IFormService $iFormService  )
    {
        $this->iFormService = $iFormService;

    }

    public function store(FormFeildsRequest $request) {


        $deviceFingerprint = $request->input('device_fingerprint');
        $canvasFingerprint = $request->input('canvas_fingerprint');
        $webglFingerprint = $request->input('webgl_fingerprint');
        $ip = $request->ip();

        $formExists = $this->iFormService->checkFormSubmission($deviceFingerprint, $canvasFingerprint, $webglFingerprint, $ip);

        if ($formExists) {
       //     return redirect()->back()->with('error', __('website.error_dublicate_form'));
       return redirect()->back()->withErrors(['error' => __('website.error_dublicate_form')]);

        }

              $isStored = $this->iFormService->storeFormData($request);

        if ($isStored) {
            return redirect()->back()->with('success_message', __('website.success_form'));
        }

      //  return redirect()->back()->with('error', __('website.error_form'));
      return redirect()->back()->withErrors(['error' => __('website.error_form')]);

    }

}
