@extends('layouts.admin')
@section('content')
<div class="panel overflow-hidden">
    <div class="panel-header d-flex justify-content-between align-items-center">
        <span>Quản lý danh mục</span>
        <a class="btn btn-dark btn-sm" href="{{ route('admin.categories.create') }}">Thêm danh mục</a>
    </div>
    <div class="panel-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead><tr><th>Tên</th><th>Slug</th><th>Số bài viết</th><th class="text-end">Thao tác</th></tr></thead>
                <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td class="fw-semibold">{{ $category->name }}</td>
                        <td class="text-muted">{{ $category->slug }}</td>
                        <td>{{ $category->posts_count }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.categories.edit',$category) }}">Sửa</a>
                            <form class="d-inline" method="post" action="{{ route('admin.categories.destroy',$category) }}">@csrf @method('delete')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa danh mục?')">Xóa</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-4 text-muted">Chưa có dữ liệu</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-3">{{ $categories->links() }}</div>
@endsection
