<?php

namespace App\Providers;

use App\Services\Dashboard\Messages\MessagesService;
use Illuminate\Support\ServiceProvider;

class ViewMessageProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(MessagesService $messageService): void
    {
        $countMessages = $messageService->countMessages();
        view()->share('countMessages', $countMessages);

        $getLastMesages = $messageService->getLastThreeMessages();
        view()->share('getLastMesages', $getLastMesages);
    }
}
