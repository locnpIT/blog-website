<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('*', function ($view): void {
            if (! Schema::hasTable('settings')) {
                return;
            }

            $settings = Setting::query()->pluck('value', 'key');
            $categories = Schema::hasTable('categories')
                ? Category::query()->withCount('posts')->orderBy('name')->get()
                : collect();
            $unreadContactsCount = Schema::hasTable('contacts')
                ? Contact::query()->where('is_read', false)->count()
                : 0;

            $view->with([
                'globalSettings' => $settings,
                'sidebarCategories' => $categories,
                'unreadContactsCount' => $unreadContactsCount,
            ]);
        });
    }
}
