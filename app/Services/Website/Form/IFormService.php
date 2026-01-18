<?php
namespace App\Services\Website\Form;

interface IFormService  {

    public function storeFormData($request);
    public function checkFormSubmission($deviceFingerprint, $canvasFingerprint, $webglFingerprint, $ip);
}
