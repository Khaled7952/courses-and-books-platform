<?php
namespace App\Repositories\Website\Form;

use App\Models\Form;
use Illuminate\Support\Facades\DB;

class FormRepository implements IFormRepository
{
    public function storeFormData($request)
    {
        $data = $request->only(['name', 'phone', 'company_name', 'email', 'message', 'device_fingerprint', 'canvas_fingerprint', 'webgl_fingerprint']);
        $data['ip'] = $request->ip();

        return Form::create($data);
    }

    public function checkFormSubmission($deviceFingerprint, $canvasFingerprint, $webglFingerprint, $ip)
    {
        $now = \Carbon\Carbon::now();
        $twentyFourHoursAgo = (clone $now)->subHours(24);
        return DB::table('forms')
            ->where(function ($query) use ($deviceFingerprint, $canvasFingerprint, $webglFingerprint, $ip) {
                $query->where('device_fingerprint', $deviceFingerprint)->orWhere('canvas_fingerprint', $canvasFingerprint)->orWhere('webgl_fingerprint', $webglFingerprint)->orWhere('ip', $ip);
            })
            ->where('created_at', '>=', $twentyFourHoursAgo)
            ->exists();
    }
}
