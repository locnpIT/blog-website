<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\ContactStoreRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function home(): View
    {
        $posts = Post::with('category')->published()->latest('published_at')->paginate(9)->onEachSide(1);
        $featuredPosts = Post::with('category')->published()->latest('published_at')->take(4)->get();
        $categories = Category::withCount('posts')->orderBy('name')->get();
        $profile = Profile::query()->first();

        return view('public.home', compact('posts', 'featuredPosts', 'categories', 'profile'));
    }

    public function showPost(string $slug): View
    {
        $post = Post::with('category')->published()->where('slug', $slug)->firstOrFail();
        $profile = Profile::query()->first();
        $sidebarCategories = Category::withCount('posts')->orderBy('name')->get();

        $relatedPosts = Post::with('category')
            ->published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.post', compact('post', 'relatedPosts', 'profile', 'sidebarCategories'));
    }

    public function showCategory(string $slug): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::with('category')->published()->where('category_id', $category->id)->latest('published_at')->paginate(9)->onEachSide(1);
        $profile = Profile::query()->first();
        $sidebarCategories = Category::withCount('posts')->orderBy('name')->get();

        return view('public.category', compact('category', 'posts', 'profile', 'sidebarCategories'));
    }

    public function about(): View
    {
        $profile = Profile::query()->first();

        return view('public.about', compact('profile'));
    }

    public function contact(): View
    {
        return view('public.contact');
    }

    public function work(): View
    {
        return view('public.work');
    }

    public function storeContact(ContactStoreRequest $request): RedirectResponse
    {
        Contact::create($request->validated() + ['ip_address' => $request->ip()]);

        return back()->with('success', 'Cảm ơn bạn đã liên hệ. Chúng tôi sẽ phản hồi sớm.');
    }
}
