@extends('layouts.admin')
@section('content')
<div class="panel overflow-hidden">
    <div class="panel-header d-flex justify-content-between align-items-center">
        <span>Quản lý bài viết</span>
        <a class="btn btn-dark btn-sm" href="{{ route('admin.posts.create') }}">Thêm bài viết</a>
    </div>
    <div class="panel-body p-0">
        <div class="table-responsive">
            <table class="table mb-0 align-middle">
                <thead><tr><th style="min-width:90px">Ảnh</th><th>Tiêu đề</th><th>Danh mục</th><th>Trạng thái</th><th class="text-end">Thao tác</th></tr></thead>
                <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>@if($post->thumbnail)<img src="{{ $post->thumbnail_url }}" width="78" height="54" style="object-fit:cover;border:1px solid rgba(0,0,0,.1)" alt="thumb">@endif</td>
                        <td><div class="fw-semibold">{{ $post->title }}</div><small class="text-muted">{{ $post->slug }}</small></td>
                        <td>{{ $post->category->name }}</td>
                        <td><span class="badge {{ $post->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $post->status }}</span></td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.posts.edit',$post) }}">Sửa</a>
                            <form class="d-inline" method="post" action="{{ route('admin.posts.destroy',$post) }}">@csrf @method('delete')<button class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa bài viết?')">Xóa</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">Chưa có dữ liệu</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mt-3">{{ $posts->links() }}</div>
@endsection
