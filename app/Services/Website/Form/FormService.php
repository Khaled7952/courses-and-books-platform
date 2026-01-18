<?php
namespace App\Services\Website\Form;

use App\Mail\FormSubmissionMail;
use App\Notifications\FormContactNotification;
use App\Notifications\FormSubmissionNotification;
use App\Repositories\Website\Form\IFormRepository;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class FormService implements IFormService  {


    protected $iFormRepository;


    public function __construct(IFormRepository $iFormRepository  )
    {
        $this->iFormRepository = $iFormRepository;

    }

    public function storeFormData($request){

        $storedData = $this->iFormRepository->storeFormData($request);
      //  $recipientEmail = 'akhaled795@gmail.com';
        $recipientEmail = \App\Models\Setting::select('email')->value('email') ?? 'info@s-alqhtani.com';


        if ($storedData) {

       // FacadesNotification:: route('mail', $recipientEmail)->notify(new FormContactNotification($storedData));
        FacadesNotification::route('mail', $recipientEmail)->notifyNow(new FormContactNotification($storedData));


            return true;
        }

        return false;
    }

    public function checkFormSubmission($deviceFingerprint, $canvasFingerprint, $webglFingerprint, $ip){

        return $this->iFormRepository->checkFormSubmission($deviceFingerprint, $canvasFingerprint, $webglFingerprint, $ip);
    }


}
