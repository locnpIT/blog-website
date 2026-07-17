<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '../../Layouts/PublicLayout.vue';
import Pagination from '../../Components/Pagination.vue';
import PostList from '../../Components/PostList.vue';
import SidebarCards from '../../Components/SidebarCards.vue';

defineProps({
    posts: Object,
    query: String,
    profile: Object,
    sidebarCategories: Array,
    seo: Object,
});
</script>

<template>
    <Head :title="seo.title" />
    <PublicLayout>
        <section class="simple-hero simple-hero-tight">
            <p class="eyebrow">Tìm kiếm</p>
            <h1 v-if="query">Kết quả cho “{{ query }}”</h1>
            <h1 v-else>Tìm bài viết</h1>
            <p v-if="query">Có {{ posts.total }} bài viết phù hợp với từ khóa bạn nhập.</p>
            <p v-else>Nhập từ khóa ở ô tìm kiếm phía trên để lọc theo tiêu đề, mô tả, nội dung hoặc danh mục.</p>
        </section>

        <div class="content-layout">
            <section class="section-block">
                <template v-if="query && !posts.data.length">
                    <div class="search-empty">
                        <i class="fas fa-search search-empty-icon"></i>
                        <p class="search-empty-title">Không tìm thấy kết quả nào</p>
                        <p class="search-empty-sub">Không có bài viết nào phù hợp với "{{ query }}". Thử từ khóa khác hoặc xem tất cả bài viết.</p>
                        <Link href="/" class="btn-ghost">Xem tất cả bài viết</Link>
                    </div>
                </template>
                <template v-else>
                    <PostList :posts="posts.data" />
                    <div style="margin-top: 0.75rem;">
                        <Pagination :links="posts.links" />
                    </div>
                </template>
            </section>
            <aside class="home-sidebar">
                <SidebarCards :profile="profile" :categories="sidebarCategories" />
            </aside>
        </div>
    </PublicLayout>
</template>
