<section class="sidebar-card">
    <h3>Về tôi</h3>
    <div class="about-avatar">
        @if(!empty($profile?->avatar_url))
            <img class="about-avatar-image" src="{{ $profile->avatar_url }}" alt="{{ $profile?->full_name ?: ($globalSettings['author_name'] ?? 'Đang cập nhật') }}">
        @else
            <div class="about-avatar-inner">
                {{ strtoupper(mb_substr($globalSettings['author_name'] ?? 'PL', 0, 2)) }}
            </div>
        @endif
    </div>
    <p class="about-name">{{ $profile?->full_name ?: ($globalSettings['author_name'] ?? 'Đang cập nhật') }}</p>
    <p class="about-text">{{ $profile?->headline ?: ($globalSettings['author_bio'] ?? 'Blog cá nhân chia sẻ kiến thức và ghi chép kỹ thuật.') }}</p>
    <a href="{{ route('about') }}" class="button-soft">Tìm hiểu thêm</a>
</section>
