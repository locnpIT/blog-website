<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => fn () => $request->user() ? [
                    'id' => $request->user()->id,
                    'name' => $request->user()->name,
                    'email' => $request->user()->email,
                ] : null,
            ],
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
            ],
            'globalSettings' => fn () => Schema::hasTable('settings')
                ? Setting::query()->pluck('value', 'key')
                : collect(),
            'sidebarCategories' => fn () => Schema::hasTable('categories')
                ? Category::query()->withCount('posts')->orderBy('name')->get()
                : collect(),
            'unreadContactsCount' => fn () => Schema::hasTable('contacts')
                ? Contact::query()->where('is_read', false)->count()
                : 0,
        ]);
    }
}
