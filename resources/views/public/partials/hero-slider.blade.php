@php
    $slides = collect($posts ?? [])->filter()->values();
@endphp

@if($slides->isNotEmpty())
<section class="hero-slider" data-hero-slider>
    <div class="hero-slider-track" data-slider-track>
        @foreach($slides as $index => $post)
            <article class="hero-slide {{ $index === 0 ? 'is-active' : '' }}" data-slider-slide>
                <a href="{{ route('posts.show', $post->slug) }}" class="hero-slide-link">
                    <div class="hero-slide-image">
                        @if($post->thumbnail)
                            <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}">
                        @else
                            <div class="hero-slide-fallback"></div>
                        @endif
                    </div>
                    <div class="hero-slide-card">
                        <p class="hero-slide-category">{{ $post->category->name }}</p>
                        <h1>{{ $post->title }}</h1>
                        <p>{{ \Illuminate\Support\Str::limit($post->excerpt, 140) }}</p>
                        <span class="hero-cta">Đọc thêm</span>
                    </div>
                </a>
            </article>
        @endforeach
    </div>

    <button class="slider-arrow slider-prev" type="button" data-slider-prev aria-label="Bài trước">‹</button>
    <button class="slider-arrow slider-next" type="button" data-slider-next aria-label="Bài tiếp">›</button>

    <div class="slider-dots" data-slider-dots>
        @foreach($slides as $index => $post)
            <button type="button" class="slider-dot {{ $index === 0 ? 'is-active' : '' }}" data-slider-dot="{{ $index }}" aria-label="Chuyển sang slide {{ $index + 1 }}"></button>
        @endforeach
    </div>
</section>
@endif
