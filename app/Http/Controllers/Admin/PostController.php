<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Support\WebpImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function index(): Response
    {
        $posts = Post::with('category')->latest()->paginate(10)->through(fn (Post $post) => $this->postPayload($post));

        return Inertia::render('Admin/Posts/Index', compact('posts'));
    }

    public function create(): Response
    {
        $categories = Category::orderBy('name')->get();

        return Inertia::render('Admin/Posts/Form', compact('categories'));
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Post::generateUniqueSlug($data['title']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = WebpImage::store($request->file('thumbnail'), 'posts');
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Tạo bài viết thành công.');
    }

    public function edit(Post $post): Response
    {
        $categories = Category::orderBy('name')->get();

        return Inertia::render('Admin/Posts/Form', [
            'post' => $this->postPayload($post) + ['content' => $post->content],
            'categories' => $categories,
        ]);
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Post::generateUniqueSlug($data['title'], $post->id);

        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }

            $data['thumbnail'] = WebpImage::store($request->file('thumbnail'), 'posts');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Cập nhật bài viết thành công.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        $post->delete();

        return back()->with('success', 'Đã xóa bài viết.');
    }

    private function postPayload(Post $post): array
    {
        return [
            'id' => $post->id,
            'title' => $post->title,
            'slug' => $post->slug,
            'excerpt' => $post->excerpt,
            'content' => $post->content,
            'thumbnail_url' => $post->thumbnail_url,
            'category_id' => $post->category_id,
            'category' => $post->category,
            'status' => $post->status,
            'published_at' => optional($post->published_at)->toDateTimeString(),
        ];
    }
}
