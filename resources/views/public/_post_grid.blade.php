<div class="posts-list">
    @forelse($posts as $post)
        <article class="post-item">
            <a href="{{ route('posts.show', $post->slug) }}" class="post-thumb">
                @if($post->thumbnail)
                    <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}">
                @endif
            </a>
            <div class="post-body">
                <p class="post-meta">{{ $post->category->name }} · {{ optional($post->published_at)->format('d/m/Y') }}</p>
                <a class="post-title" href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                <p class="post-excerpt">{{ \Illuminate\Support\Str::limit($post->excerpt, 140) }}</p>
            </div>
        </article>
    @empty
        <div class="empty-state">Chưa có bài viết</div>
    @endforelse
</div>

<div class="pagination-wrap">{{ $posts->links() }}</div>
