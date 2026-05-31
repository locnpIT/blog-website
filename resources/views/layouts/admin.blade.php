<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản trị - {{ $globalSettings['site_title'] ?? 'PhuocLocBlog' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="app-shell">
    <nav class="navbar navbar-expand-lg topbar py-3">
        <div class="container-fluid px-4">
                <a class="navbar-brand brand" href="{{ route('admin.dashboard') }}">PhuocLocBlog CMS</a>
                <div class="d-flex gap-2">
                    <a href="{{ route('home') }}" class="btn btn-light border btn-sm">Xem trang web</a>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-dark btn-sm" type="submit">Đăng xuất</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container-fluid px-4 py-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-4">
            <div class="col-xl-2 col-lg-3">
                <div class="panel admin-sidebar overflow-hidden">
                    <div class="panel-header">Điều hướng</div>
                    <div class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Tổng quan</a>
                        <a class="list-group-item list-group-item-action {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">Danh mục</a>
                        <a class="list-group-item list-group-item-action {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">Bài viết</a>
                        <a class="list-group-item list-group-item-action d-flex justify-content-between {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">Liên hệ <span class="badge text-bg-danger">{{ $unreadContactsCount ?? 0 }}</span></a>
                        <a class="list-group-item list-group-item-action {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.edit') }}">Cài đặt</a>
                        <a class="list-group-item list-group-item-action {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}" href="{{ route('admin.profile.edit') }}">Hồ sơ giới thiệu</a>
                        <a class="list-group-item list-group-item-action {{ request()->routeIs('admin.visits.*') ? 'active' : '' }}" href="{{ route('admin.visits.index') }}">Lượt truy cập</a>
                        <a class="list-group-item list-group-item-action {{ request()->routeIs('admin.security.*') ? 'active' : '' }}" href="{{ route('admin.security.password.edit') }}">Bảo mật</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-10 col-lg-9">
                @yield('content')
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
@stack('scripts')
</body>
</html>
