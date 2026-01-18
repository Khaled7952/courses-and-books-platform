<?php
namespace App\Services\Dashboard\Settings;


interface ISettingService  {

 public function getSetting($id);
 public function updateSetting($data, $id);


}
