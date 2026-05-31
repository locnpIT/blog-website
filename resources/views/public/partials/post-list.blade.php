<div class="post-list">
    @forelse($posts as $post)
        <article class="post-row">
            <a href="{{ route('posts.show', $post->slug) }}" class="post-row-media">
                @if($post->thumbnail)
                    <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}">
                @else
                    <div class="post-row-fallback"></div>
                @endif
            </a>
            <div class="post-row-body">
                <p class="post-row-meta">{{ $post->category->name }} · {{ optional($post->published_at)->format('d/m/Y') }}</p>
                <a href="{{ route('posts.show', $post->slug) }}" class="post-row-title">{{ $post->title }}</a>
                <p class="post-row-excerpt">{{ \Illuminate\Support\Str::limit($post->excerpt, 160) }}</p>
                <a href="{{ route('posts.show', $post->slug) }}" class="read-more">Đọc thêm →</a>
            </div>
        </article>
    @empty
        <div class="empty-state">Chưa có bài viết</div>
    @endforelse
</div>

<div class="pagination-wrap">{{ $posts->links() }}</div>
