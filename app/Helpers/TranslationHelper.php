<?php

// app/Helpers/TranslationHelper.php

namespace App\Helpers;

class TranslationHelper
{
    public static function getTranslatedSlug($model, $slug)
    {
        $locale = app()->getLocale();
        $newLocale = $locale == 'ar' ? 'en' : 'ar';
        $item = $model::where("slug->{$locale}", $slug)->first();
        return $item ? $item->getTranslation('slug', $newLocale) : $slug;
    }
}

