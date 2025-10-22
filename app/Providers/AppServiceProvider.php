<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        //four categories for footer
        if (Schema::hasTable('categories')) {
            $footerCategories = Category::orderBy('created_at', 'desc')
                ->take(4)
                ->get();
            view()->share(compact('footerCategories'));
        }
        //three latest project
        if (Schema::hasTable('projects')) {
            $latestFooterProjects = Project::standardRequest()
                ->take(3)
                ->get();
            view()->share(compact('latestFooterProjects'));
        }
        if (Schema::hasTable('categories')) {
            $allCategoriesForBlogPartial = Category::withCount(['projects' => function ($query) {
                $query->orderBy('created_at', 'desc')
                ->where('enable', 1);
            }])->get();
            view()->share(compact('allCategoriesForBlogPartial'));
        }
        /*if (Schema::hasTable('tags')) {
            $allTagsForBlogPartial = Tag::withCount(['projects as enabled_projects_count' => function ($query) {
                $query->where('enable', true);
            }])
                ->orderByDesc('enabled_projects_count')
                ->get();

            view()->share(compact('allTagsForBlogPartial'));
        }*/
    }
}
