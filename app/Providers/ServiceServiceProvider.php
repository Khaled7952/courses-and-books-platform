<?php

namespace App\Providers;

use App\Services\Dashboard\Auth\AuthService;
use App\Services\Dashboard\Auth\IAuthService;
use App\Services\Dashboard\Blog\BlogService;
use App\Services\Dashboard\Blog\IBlogService;
use App\Services\Dashboard\Book\BookService;
use App\Services\Dashboard\Book\IBookService;
use App\Services\Dashboard\Category\CategoryService;
use App\Services\Dashboard\Category\ICategoryService;
use App\Services\Dashboard\CodeSnippet\CodeSnippetService;
use App\Services\Dashboard\CodeSnippet\ICodeSnippetService;
use App\Services\Dashboard\Courses\CoursesService;
use App\Services\Dashboard\Courses\ICoursesService;
use App\Services\Dashboard\Messages\IMessagesService;
use App\Services\Dashboard\Messages\MessagesService;
use App\Services\Dashboard\RolesAndManagers\Managers\IManagerServices;
use App\Services\Dashboard\RolesAndManagers\Managers\ManagerServices;
use App\Services\Dashboard\RolesAndManagers\Roles\IRolesServices;
use App\Services\Dashboard\RolesAndManagers\Roles\RolesServices;
use App\Services\Dashboard\Seo\ISeoService;
use App\Services\Dashboard\Seo\SeoService;
use App\Services\Dashboard\Settings\ISettingService;
use App\Services\Dashboard\Settings\SettingService;
use App\Services\Dashboard\Tag\ITagService;
use App\Services\Dashboard\Tag\TagService;
use App\Services\Website\Blog\BlogWebService;
use App\Services\Website\Blog\IBlogWebService;
use App\Services\Website\CartManager\CartManager;
use App\Services\Website\CartManager\ICartManager;
use App\Services\Website\Courses\CoursesWebService;
use App\Services\Website\Courses\ICoursesWebService;
use App\Services\Website\Form\FormService;
use App\Services\Website\Form\IFormService;
use App\Services\Website\Home\HomeService;
use App\Services\Website\Home\IHomeService;
use App\Services\Website\Pay\IPayService;
use App\Services\Website\Pay\PayService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IAuthService::class,AuthService::class);
        $this->app->bind(IRolesServices::class,RolesServices::class);
        $this->app->bind(IManagerServices::class,ManagerServices::class);
        $this->app->bind(ISettingService::class,SettingService::class);
        $this->app->bind(IBookService::class,BookService::class);

        $this->app->bind(IMessagesService::class,MessagesService::class);
        $this->app->bind(ISeoService::class,SeoService::class);
        $this->app->bind(IHomeService::class,HomeService::class);
        $this->app->bind(IFormService::class,FormService::class);
        $this->app->bind(ICodeSnippetService::class,CodeSnippetService::class);


        $this->app->bind(ITagService::class, TagService::class);
        $this->app->bind(ICategoryService::class,CategoryService::class);
        $this->app->bind(IBlogService::class,BlogService::class);
        $this->app->bind(ICoursesService::class,CoursesService::class);

        $this->app->bind(IBlogWebService::class,BlogWebService::class);
        $this->app->bind(ICoursesWebService::class,CoursesWebService::class);
        $this->app->bind(ICartManager::class,CartManager::class);
         $this->app->bind(IPayService::class, PayService::class);


    }

    /**
     * Bootstrap services.
     */

    public function boot(): void
    {
        //
    }
}
