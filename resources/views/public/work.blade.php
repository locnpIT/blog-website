@extends('layouts.public')
@section('title', 'Làm việc - ' . ($globalSettings['site_title'] ?? 'PhuocLocBlog'))
@section('meta_description', 'Thiết kế website chuẩn doanh nghiệp, production-ready, chuẩn SEO, responsive tốt, có hỗ trợ tên miền và hosting theo gói.')
@section('og_type', 'website')

@section('content')
@php
    $contactLink = route('contact');
@endphp

<div class="work-page">
    <section class="work-hero" style="--work-hero-image: url('{{ asset('images/HeroBannerForWork.png') }}');">
        <div class="work-hero-copy">
            <p class="eyebrow">Làm việc</p>
            <h1>Website chuẩn doanh nghiệp, production-ready và tối ưu SEO</h1>
            <p class="work-lead">
                Dành cho doanh nghiệp, startup và cá nhân cần một website làm thật: rõ thương hiệu, dễ vận hành,
                tốc độ tốt và đủ nền tảng để mở rộng lâu dài.
            </p>
            <div class="work-actions">
                <a href="{{ $contactLink }}" class="btn-pastel">Liên hệ ngay</a>
                <a href="#work-process" class="about-link">Xem quy trình</a>
            </div>
            <div class="work-note-row">
                <span>Chuẩn SEO</span>
                <span>Bảo mật</span>
                <span>Ổn định</span>
                <span>Tên miền + hosting</span>
                <span>Bàn giao rõ ràng</span>
            </div>
        </div>
    </section>

    <section class="work-strip">
        <article class="work-stat">
            <span>Phù hợp</span>
            <strong>Doanh nghiệp, cá nhân, startup</strong>
        </article>
        <article class="work-stat">
            <span>Định hướng</span>
            <strong>Production-ready, dễ mở rộng</strong>
        </article>
        <article class="work-stat">
            <span>SEO</span>
            <strong>Cấu trúc tốt, dễ index</strong>
        </article>
        <article class="work-stat">
            <span>Hỗ trợ</span>
            <strong>Domain + hosting + bảo trì</strong>
        </article>
    </section>

    <section class="work-grid">
        <article class="work-section-card">
          
            <h2>Mình làm gì</h2>
            <p>
                Mình tập trung vào website có nền tảng rõ ràng: giao diện sạch, nội dung dễ đọc, quản trị nội dung
                thuận tiện và đủ tốt để dùng cho vận hành thực tế.
            </p>
            <ul class="work-bullets">
                <li>Website giới thiệu công ty / dịch vụ</li>
                <li>Landing page chiến dịch</li>
                <li>Blog cá nhân / blog kỹ thuật</li>
                <li>Trang nội dung cần chuẩn SEO và tốc độ tốt</li>
            </ul>
        </article>

        <article class="work-section-card">
            <h2>Những gì bạn nhận được</h2>
            <ul class="work-feature-list">
                <li>Thiết kế đồng bộ theo nhận diện thương hiệu</li>
                <li>Responsive tốt trên desktop và điện thoại</li>
                <li>Chuẩn SEO on-page cơ bản và cấu trúc nội dung rõ</li>
                <li>Tối ưu hình ảnh, spacing, tốc độ hiển thị</li>
                <li>Hướng dẫn sử dụng để tự cập nhật nội dung</li>
            </ul>
        </article>

        <article class="work-section-card work-section-card-wide" id="work-process">
            <h2>Quy trình làm việc</h2>
            <p class="work-process-lead">Một luồng làm việc rõ ràng giúp bạn kiểm soát tiến độ, nội dung và phạm vi ngay từ đầu.</p>
            <div class="work-timeline">
                <div class="work-step">
                    <span class="work-step-index">01</span>
                    <strong>1. Trao đổi nhu cầu</strong>
                    <p>Xác định mục tiêu, nội dung, đối tượng khách hàng và phạm vi website.</p>
                </div>
                <div class="work-step">
                    <span class="work-step-index">02</span>
                    <strong>2. Chốt cấu trúc</strong>
                    <p>Phác thảo sitemap, luồng nội dung và định hướng giao diện.</p>
                </div>
                <div class="work-step">
                    <span class="work-step-index">03</span>
                    <strong>3. Thiết kế và triển khai</strong>
                    <p>Hoàn thiện UI, code production-ready và kiểm tra responsive.</p>
                </div>
                <div class="work-step">
                    <span class="work-step-index">04</span>
                    <strong>4. Bàn giao & hỗ trợ</strong>
                    <p>Hướng dẫn sử dụng, chỉnh sửa nhỏ theo thỏa thuận và hỗ trợ vận hành ban đầu.</p>
                </div>
            </div>
        </article>

        <article class="work-section-card work-case-study">
            <h2>Một dự án điển hình</h2>
            <div class="work-case-study-layout">
                <div class="work-case-study-panel">
                    <span class="work-case-label">Bối cảnh</span>
                    <p>Một doanh nghiệp dịch vụ cần website giới thiệu rõ ràng, có form liên hệ, dễ mở rộng về sau.</p>
                </div>
                <div class="work-case-study-panel">
                    <span class="work-case-label">Giải pháp</span>
                    <p>Tối giản giao diện, cấu trúc nội dung theo mục tiêu chuyển đổi và tối ưu SEO kỹ thuật ngay từ đầu.</p>
                </div>
                <div class="work-case-study-panel">
                    <span class="work-case-label">Kết quả</span>
                    <p>Website gọn, nhẹ, dễ quản trị, phù hợp chạy production và thuận tiện khi phát triển thêm tính năng.</p>
                </div>
            </div>
        </article>

        <article class="work-section-card work-section-card-wide">
            <h2>Phù hợp nếu bạn cần</h2>
            <div class="work-tags">
                <span>Website doanh nghiệp</span>
                <span>Landing page</span>
                <span>Website dịch vụ</span>
                <span>Website chuẩn SEO</span>
                <span>Miễn phí tên miền</span>
                <span>Miễn phí hosting</span>
            </div>
        </article>
    </section>

    <section class="work-cta">
        <div>
            <p class="eyebrow">Sẵn sàng bắt đầu</p>
            <h2>Nếu bạn muốn làm một website nghiêm túc, mình có thể trao đổi chi tiết với bạn.</h2>
            <p>
                Gửi cho mình mục tiêu, lĩnh vực và những trang bạn cần. Mình sẽ phản hồi theo hướng thực tế,
                rõ phạm vi và phù hợp với cách vận hành của bạn.
            </p>
        </div>
        <a href="{{ $contactLink }}" class="btn-pastel">Liên hệ làm website</a>
    </section>
</div>
@endsection
