<div class="row g-4">
    <div class="col-lg-8">
        <div class="row g-4">
            @forelse($posts as $post)
                <div class="col-md-6 col-xl-4">
                    <article class="recent-card">
                        @if($post->thumbnail)
                            <img src="{{ $post->thumbnail_url }}" class="recent-thumb" alt="{{ $post->title }}">
                        @else
                            <div class="recent-fallback"></div>
                        @endif
                        <div class="recent-body">
                            <a class="recent-title" href="{{ route('posts.show',$post->slug) }}">{{ $post->title }}</a>
                            <p class="recent-excerpt">{{ \Illuminate\Support\Str::limit($post->excerpt, 110) }}</p>
                            <div class="meta">{{ $post->category->name }} • {{ optional($post->published_at)->format('d/m/Y') }}</div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12"><div class="panel"><div class="panel-body text-center text-muted">Chưa có bài viết</div></div></div>
            @endforelse
        </div>
        <div class="mt-4">{{ $posts->links() }}</div>
    </div>

    <div class="col-lg-4">
        <div class="panel sidebar-sticky mb-3">
            <div class="panel-header">Danh mục</div>
            <div class="panel-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($sidebarCategories as $category)
                        <li class="list-group-item d-flex justify-content-between">
                            <a class="text-decoration-none" href="{{ route('categories.show',$category->slug) }}">{{ $category->name }}</a>
                            <span class="text-muted">{{ $category->posts_count }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted">Không có danh mục</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
