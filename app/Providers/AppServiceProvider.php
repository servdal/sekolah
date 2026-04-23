<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

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
        View::composer('layouts.app', function ($view) {
            $menuPages = collect();
            $sidebarCategories = collect();
            $recentPosts = collect();
            $archives = collect();

            if (Schema::hasTable('pages')) {
                $menuPages = Page::query()
                    ->where('status', 'published')
                    ->where('show_in_menu', true)
                    ->orderBy('title')
                    ->get();
            }

            if (Schema::hasTable('categories')) {
                $sidebarCategories = Category::query()
                    ->withCount([
                        'posts as posts_count' => function ($query) {
                            $query->where('status', 'published')
                                ->whereNotNull('published_at');
                        },
                    ])
                    ->orderBy('name')
                    ->get();
            }

            if (Schema::hasTable('posts')) {
                $recentPosts = Post::query()
                    ->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->latest('published_at')
                    ->limit(5)
                    ->get();

                $archives = Post::query()
                    ->selectRaw('YEAR(published_at) as year, MONTH(published_at) as month, COUNT(*) as total')
                    ->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->groupByRaw('YEAR(published_at), MONTH(published_at)')
                    ->orderByRaw('YEAR(published_at) DESC, MONTH(published_at) DESC')
                    ->get();
            }

            $view->with(compact('menuPages', 'sidebarCategories', 'recentPosts', 'archives'));
        });
    }
}
