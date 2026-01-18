<?php
namespace App\Repositories\Website\Form;


interface IFormRepository{

    public function storeFormData($request);
    public function checkFormSubmission($deviceFingerprint, $canvasFingerprint, $webglFingerprint, $ip);

}
