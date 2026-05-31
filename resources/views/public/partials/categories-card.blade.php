<section class="sidebar-card">
    <h3>Danh mục</h3>
    <ul class="category-list">
        @forelse($categories as $category)
            <li>
                <a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a>
                <span>{{ $category->posts_count }}</span>
            </li>
        @empty
            <li class="empty-inline">Chưa có danh mục</li>
        @endforelse
    </ul>
</section>
