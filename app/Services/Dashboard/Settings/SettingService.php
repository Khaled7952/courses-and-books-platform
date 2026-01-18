<?php

namespace App\Services\Dashboard\Settings;

use App\Repositories\Dashboard\Settings\ISettingRepository;
use App\Utils\ImageManger;

class SettingService implements ISettingService
{
    protected $settingRepository, $imageManger;

    public function __construct(ISettingRepository $settingRepository, ImageManger $imageManger)
    {
        $this->settingRepository = $settingRepository;
        $this->imageManger = $imageManger;
    }

    public function getSetting($id)
    {
        $setting = $this->settingRepository->getSetting($id);
        return $setting ?? abort(404);
    }

  public function updateSetting($data, $id)
{
    $setting = $this->getSetting($id);

    // logo
    if (!empty($data['logo'])) {
        $oldLogo = 'uploads/general/' . $setting->logo;
        $this->imageManger->deleteImageFromLocal($oldLogo);

        $data['logo'] = $this->imageManger->uploadSingleImage('/', $data['logo'], 'general');
    }

    // hero book image
    if (!empty($data['hero_book_image'])) {
        $oldBookImage = 'uploads/general/' . $setting->hero_book_image;
        $this->imageManger->deleteImageFromLocal($oldBookImage);

        $data['hero_book_image'] = $this->imageManger->uploadSingleImage('/', $data['hero_book_image'], 'general');
    }

    $updated = $this->settingRepository->updateSetting($data, $setting);

    cache()->forget('settings');

    return $updated;
}

}
