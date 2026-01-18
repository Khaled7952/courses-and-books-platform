<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Setting;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use Illuminate\Support\Facades\Session;
use App\Services\Dashboard\Settings\ISettingService;

class SettingController extends Controller
{
    protected $settingService;
    public function __construct(ISettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([
                'email' => null,
                'phone' => null,
                'whatsapp' => null,
                'address' => null,
                'logo' => null,
                'hero_book_image' => null,
                'hero_title' => null,
                'hero_description' => null,
                'banner_title' => null,
                'banner_subtitle' => null,
                'doctor_about' => null,
                'social_links' => [],
            ]);
        }

        return view('dashboard.settings.setting', compact('setting'));
    }

    public function update(SettingsRequest $request, $id)
    {
        $data = $request->except(['_token', '_method']);

        $updated = $this->settingService->updateSetting($data, $id);

        if (!$updated) {
            Session::flash('error', __('dashboard.error_msg'));
            return redirect()->back();
        }

        Session::flash('success', __('dashboard.success_msg'));
        return redirect()->back();
    }
}
