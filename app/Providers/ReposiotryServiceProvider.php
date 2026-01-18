<?php

namespace App\Providers;

use App\Repositories\Dashboard\Auth\AuthRepository;
use App\Repositories\Dashboard\Auth\IAuthRepository;
use App\Repositories\Dashboard\Blog\BlogRepository;
use App\Repositories\Dashboard\Blog\IBlogRepository;
use App\Repositories\Dashboard\Book\BookRepository;
use App\Repositories\Dashboard\Book\IBookRepository;
use App\Repositories\Dashboard\Category\CategoryRepository;
use App\Repositories\Dashboard\Category\ICategoryRepository;
use App\Repositories\Dashboard\CodeSnippet\CodeSnippetRepository;
use App\Repositories\Dashboard\CodeSnippet\ICodeSnippetRepository;
use App\Repositories\Dashboard\Courses\CoursesRepository;
use App\Repositories\Dashboard\Courses\ICoursesRepository;
use App\Repositories\Dashboard\Faq\FaqRepository;
use App\Repositories\Dashboard\Faq\IFaqRepository;
use App\Repositories\Dashboard\FeaturesAndWorks\FeaturesAndWorksRepository;
use App\Repositories\Dashboard\FeaturesAndWorks\IFeaturesAndWorksRepository;
use App\Repositories\Dashboard\Meal\IMealRepository;
use App\Repositories\Dashboard\Meal\MealRepository;
use App\Repositories\Dashboard\Messages\MessagesRepository;
use App\Repositories\Dashboard\Messages\IMessagesRepository;
use App\Repositories\Dashboard\Package\IPackageRepository;
use App\Repositories\Dashboard\Package\PackageRepository;
use App\Repositories\Dashboard\Seo\ISeoRepository;
use App\Repositories\Dashboard\Seo\SeoRepository;
use App\Repositories\Dashboard\RolesAndManagers\Managers\IManagersRepository;
use App\Repositories\Dashboard\RolesAndManagers\Managers\ManagersRepository;
use App\Repositories\Dashboard\RolesAndManagers\Roles\IRolesRepository;
use App\Repositories\Dashboard\RolesAndManagers\Roles\RolesRepository;
use App\Repositories\Dashboard\Settings\ISettingRepository;
use App\Repositories\Dashboard\Settings\SettingRepository;
use App\Repositories\Dashboard\Tag\ITagRepository;
use App\Repositories\Dashboard\Tag\TagRepository;
use App\Repositories\Dashboard\Testimonials\ITestimonialRepository;
use App\Repositories\Dashboard\Testimonials\TestimonialRepository;
use App\Repositories\Website\Form\FormRepository;
use App\Repositories\Website\Form\IFormRepository;
use App\Repositories\Website\Home\HomeRepository;
use App\Repositories\Website\Home\IHomeRepository;
use Illuminate\Support\ServiceProvider;

class ReposiotryServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(IAuthRepository::class,AuthRepository::class);
        $this->app->bind(IRolesRepository::class,RolesRepository::class);
        $this->app->bind(IManagersRepository::class,ManagersRepository::class);
        $this->app->bind(ISettingRepository::class,SettingRepository::class);
        $this->app->bind(IBookRepository::class,BookRepository::class);

        $this->app->bind(ISeoRepository::class,SeoRepository::class);
        $this->app->bind(IMessagesRepository::class,MessagesRepository::class);
        $this->app->bind(IHomeRepository::class,HomeRepository::class);
        $this->app->bind(IFormRepository::class,FormRepository::class);
        $this->app->bind(ICodeSnippetRepository::class,CodeSnippetRepository::class);

        $this->app->bind(ICategoryRepository::class,CategoryRepository::class);
        $this->app->bind(IBlogRepository::class,BlogRepository::class);
        $this->app->bind(ITagRepository::class,TagRepository::class);
        $this->app->bind(ICoursesRepository::class,CoursesRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
