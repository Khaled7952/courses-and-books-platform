<?php
namespace App\Repositories\Dashboard\Settings;


interface ISettingRepository{

    public function getSetting($id);
    public function updateSetting($data, $setting);
}
