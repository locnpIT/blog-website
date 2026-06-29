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
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    public function home(): Response
    {
        $posts = Post::with('category')->published()->latest('published_at')->paginate(9)->onEachSide(1)->through(fn (Post $post) => $this->postPayload($post));
        $featuredPosts = Post::with('category')->published()->latest('published_at')->take(4)->get()->map(fn (Post $post) => $this->postPayload($post));
        $categories = Category::withCount('posts')->orderBy('name')->get();
        $profile = Profile::query()->first();

        $settings = Setting::query()->pluck('value', 'key');

        return Inertia::render('Public/Home', [
            'posts' => $posts,
            'featuredPosts' => $featuredPosts,
            'categories' => $categories,
            'profile' => $this->profilePayload($profile),
            'seo' => [
                'title' => ($settings['site_title'] ?? 'PhuocLocBlog').' - Trang chủ',
                'description' => $settings['site_description'] ?? ($settings['author_bio'] ?? 'Blog cá nhân chia sẻ về Laravel, hệ thống web, thiết kế giao diện và kinh nghiệm thực chiến.'),
                'type' => 'website',
            ],
        ]);
    }

    public function showPost(string $slug): Response
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
            ->get()
            ->map(fn (Post $post) => $this->postPayload($post));

        return Inertia::render('Public/Post', [
            'post' => $this->postPayload($post) + ['content' => $post->content],
            'relatedPosts' => $relatedPosts,
            'profile' => $this->profilePayload($profile),
            'sidebarCategories' => $sidebarCategories,
            'seo' => [
                'title' => $post->title,
                'description' => Str::limit(strip_tags($post->excerpt ?: $post->content), 155),
                'type' => 'article',
            ],
        ]);
    }

    public function showCategory(string $slug): Response
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::with('category')->published()->where('category_id', $category->id)->latest('published_at')->paginate(9)->onEachSide(1)->through(fn (Post $post) => $this->postPayload($post));
        $profile = Profile::query()->first();
        $sidebarCategories = Category::withCount('posts')->orderBy('name')->get();

        return Inertia::render('Public/Category', [
            'category' => $category,
            'posts' => $posts,
            'profile' => $this->profilePayload($profile),
            'sidebarCategories' => $sidebarCategories,
            'seo' => [
                'title' => $category->name,
                'description' => $category->description ?: 'Các bài viết thuộc danh mục '.$category->name.'.',
                'type' => 'website',
            ],
        ]);
    }

    public function about(): Response
    {
        $profile = Profile::query()->first();

        return Inertia::render('Public/About', [
            'profile' => $this->profilePayload($profile),
            'seo' => [
                'title' => 'Giới thiệu',
                'description' => 'Thông tin giới thiệu, kỹ năng và kinh nghiệm làm việc.',
                'type' => 'website',
            ],
        ]);
    }

    public function contact(): Response
    {
        return Inertia::render('Public/Contact', [
            'seo' => [
                'title' => 'Liên hệ',
                'description' => 'Liên hệ với PhuocLocBlog để trao đổi hợp tác, góp ý hoặc đặt câu hỏi về nội dung kỹ thuật.',
                'type' => 'website',
            ],
        ]);
    }

    public function work(): Response
    {
        return Inertia::render('Public/Work', [
            'seo' => [
                'title' => 'Làm việc',
                'description' => 'Hợp tác xây dựng sản phẩm web, Laravel, Vue và hệ thống quản trị nội dung.',
                'type' => 'website',
            ],
        ]);
    }

    public function storeContact(ContactStoreRequest $request): RedirectResponse
    {
        Contact::create($request->validated() + ['ip_address' => $request->ip()]);

        return back()->with('success', 'Cảm ơn bạn đã liên hệ. Chúng tôi sẽ phản hồi sớm.');
    }

    private function postPayload(Post $post): array
    {
        return [
            'id' => $post->id,
            'title' => $post->title,
            'slug' => $post->slug,
            'excerpt' => $post->excerpt,
            'thumbnail_url' => $post->thumbnail_url,
            'status' => $post->status,
            'category_id' => $post->category_id,
            'category' => $post->category,
            'published_date' => optional($post->published_at)->format('d/m/Y'),
            'published_datetime' => optional($post->published_at)->format('d/m/Y H:i'),
            'created_date' => optional($post->created_at)->format('d/m/Y'),
        ];
    }

    private function profilePayload(?Profile $profile): ?array
    {
        if (! $profile) {
            return null;
        }

        return $profile->toArray() + ['avatar_url' => $profile->avatar_url];
    }
}
