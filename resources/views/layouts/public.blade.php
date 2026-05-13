<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $globalSettings['site_title'] ?? 'PhuocLocBlog' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="app-shell">
    <nav class="navbar navbar-expand-lg topbar py-3">
        <div class="container">
            <a class="navbar-brand brand" href="{{ route('home') }}">{{ $globalSettings['site_title'] ?? 'PhuocLocBlog' }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Giới thiệu</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Liên hệ</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4 py-lg-5">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>

    <footer class="main-footer">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-5 col-md-6">
                    <div class="footer-brand mb-3">{{ $globalSettings['site_title'] ?? 'PhuocLocBlog' }}</div>
                    <p class="footer-bio">{{ $globalSettings['author_bio'] ?? 'Blog chia sẻ kiến thức Laravel, hệ thống web và kinh nghiệm kỹ thuật thực chiến.' }}</p>
                    <div class="footer-social">
                        @if($globalSettings['social_facebook'] ?? '')
                            <a href="{{ $globalSettings['social_facebook'] }}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if($globalSettings['social_instagram'] ?? '')
                            <a href="{{ $globalSettings['social_instagram'] }}" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if($globalSettings['social_linkedin'] ?? '')
                            <a href="{{ $globalSettings['social_linkedin'] }}" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        @endif
                        @if($globalSettings['social_github'] ?? '')
                            <a href="{{ $globalSettings['social_github'] }}" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-heading">Liên kết</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li><a href="{{ route('about') }}">Giới thiệu</a></li>
                        <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-heading">Liên hệ</h5>
                    <p class="footer-contact-info">
                        Kết nối với tôi qua các mạng xã hội hoặc gửi tin nhắn trực tiếp qua trang liên hệ.
                    </p>
                    <a href="{{ route('contact') }}" class="footer-btn">Gửi lời nhắn</a>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">© {{ date('Y') }} {{ $globalSettings['site_title'] ?? 'PhuocLocBlog' }}. Tất cả quyền được bảo lưu.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0">Nguyễn Phước Lộc</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
