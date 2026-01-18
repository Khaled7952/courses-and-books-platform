<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendOtpMobileNotify extends Notification
{
    use Queueable;

    protected $otp;
    protected $message;
    protected $header;

    public function __construct($type = 'register')
    {
        if ($type === 'reset') {
            $this->header = config('app.name');
            $this->message = "يرجى استخدام هذا الكود لاستعادة كلمة المرور الخاصة بك.";
        } else {
            $this->header = config('app.name');
            $this->message = "يرجى استخدام هذا الكود لتفعيل حسابك.";
        }

        $this->otp = new Otp;
    }

    public function via($notifiable): array
    {
        return ['sms'];
    }

    public function toSms($notifiable)
    {
        Log::info('=== OTP PROCESS STARTED ===');

        // Make Code
        $otp = $this->otp->generate(
            $notifiable->mobile,
            'numeric',
            5,   // Number Digit
            5    // Code Life
        );

        Log::info('OTP Generated', [
            'mobile' => $notifiable->mobile,
            'otp'    => $otp->token,
        ]);

        // Make It SA
        $dests = preg_replace('/^0/', '966', $notifiable->mobile);

        Log::info('Converted Mobile', [
            'dests' => $dests,
        ]);

        // Api
        $apiUrl = "https://api.oursms.com/api-a/msgs";
        $token  = "TRxF805ubpiSztPVqisT";
        $src    = "AltaqniA";

        $body = "{$otp->token}\n{$this->message}";

        Log::info('SMS API Request', [
            'url'   => $apiUrl,
            'token' => $token,
            'src'   => $src,
            'body'  => $body,
        ]);

        // Send Message
        $response = Http::asForm()->post($apiUrl, [
            'token' => $token,
            'src'   => $src,
            'dests' => $dests,
            'body'  => $body,
        ]);

        Log::info('SMS API Response', [
            'status' => $response->status(),
            'body'   => $response->json() ?: $response->body(),
        ]);

        Log::info('=== OTP PROCESS ENDED ===');

        return $otp->token;
    }

    public function toArray($notifiable): array
    {
        return [
            'mobile' => $notifiable->mobile,
        ];
    }
}
