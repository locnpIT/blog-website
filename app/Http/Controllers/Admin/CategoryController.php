<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {
        $categories = Category::withCount('posts')->latest()->paginate(10);

        return Inertia::render('Admin/Categories/Index', compact('categories'));
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Categories/Form');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $slug = $data['slug'] ?: $data['name'];
        $data['slug'] = Category::generateUniqueSlug($slug);

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Tạo danh mục thành công.');
    }

    public function edit(Category $category): Response
    {
        return Inertia::render('Admin/Categories/Form', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();
        $slug = $data['slug'] ?: $data['name'];
        $data['slug'] = Category::generateUniqueSlug($slug, $category->id);

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return back()->with('success', 'Đã xóa danh mục.');
    }
}
