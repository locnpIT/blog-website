<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '../../Layouts/PublicLayout.vue';
import Pagination from '../../Components/Pagination.vue';
import PostList from '../../Components/PostList.vue';
import SidebarCards from '../../Components/SidebarCards.vue';

defineProps({
    posts: Object,
    featuredPosts: Array,
    categories: Array,
    profile: Object,
    seo: Object,
});
</script>

<template>
    <Head :title="seo.title" />
    <PublicLayout>

        <!-- Hero -->
        <section class="home-hero">
            <div class="hero-content">
                <p class="eyebrow">Blog cá nhân</p>
                <h1 class="hero-name">{{ profile?.full_name || 'Nguyễn Phước Lộc' }}</h1>
                <p class="hero-tagline">{{ profile?.headline || 'Chia sẻ kiến thức Laravel, hệ thống web và kinh nghiệm kỹ thuật thực chiến.' }}</p>
                <div class="hero-actions">
                    <Link class="btn-primary" href="/contact">Kết nối với tôi</Link>
                    <Link class="btn-ghost" href="/about">Giới thiệu</Link>
                </div>
            </div>
            <div class="hero-avatar-wrap">
                <div class="hero-avatar">
                    <img v-if="profile?.avatar_url" :src="profile.avatar_url" :alt="profile?.full_name">
                    <span v-else class="hero-avatar-initials">PL</span>
                </div>
            </div>
        </section>

        <!-- Featured Posts -->
        <section v-if="featuredPosts?.length" class="featured-section">
            <h2 class="section-title">Bài viết nổi bật</h2>
            <div class="featured-grid">
                <Link
                    v-for="post in featuredPosts.slice(0, 3)"
                    :key="post.id"
                    :href="`/posts/${post.slug}`"
                    class="featured-card"
                >
                    <div class="featured-card-image">
                        <img v-if="post.thumbnail_url" :src="post.thumbnail_url" :alt="post.title">
                    </div>
                    <div class="featured-card-body">
                        <span class="featured-card-cat">{{ post.category?.name || 'Bài viết' }}</span>
                        <p class="featured-card-title">{{ post.title }}</p>
                        <span class="featured-card-date">{{ post.published_date || post.created_date }}</span>
                    </div>
                </Link>
            </div>
        </section>

        <!-- Posts + Sidebar -->
        <div class="home-content">
            <div class="home-main">
                <h2 class="section-title">Bài viết mới nhất</h2>
                <PostList :posts="posts.data" />
                <Pagination :links="posts.links" />
            </div>
            <aside class="home-sidebar">
                <SidebarCards :profile="profile" :categories="categories" />
            </aside>
        </div>

        <!-- CTA Banner -->
        <section class="newsletter-banner">
            <h2>Theo dõi bài viết mới</h2>
            <p>Các ghi chú thực chiến về Laravel, hệ thống web và cách xây dựng sản phẩm số.</p>
            <Link class="newsletter-btn" href="/contact">Kết nối ngay →</Link>
        </section>

    </PublicLayout>
</template>
