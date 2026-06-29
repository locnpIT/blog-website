<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    posts: {
        type: Array,
        default: () => [],
    },
    layout: {
        type: String,
        default: 'grid',
    },
});
</script>

<template>
    <div v-if="layout === 'grid'" class="post-grid">
        <article v-for="post in posts" :key="post.id" class="post-card">
            <Link :href="`/posts/${post.slug}`" class="post-card-image">
                <img v-if="post.thumbnail_url" :src="post.thumbnail_url" :alt="post.title">
                <div v-else class="post-card-image-fallback">
                    <i class="fas fa-file-alt"></i>
                </div>
            </Link>
            <div class="post-card-body">
                <span v-if="post.category?.name" class="post-card-cat">{{ post.category.name }}</span>
                <Link class="post-card-title" :href="`/posts/${post.slug}`">{{ post.title }}</Link>
                <p v-if="post.excerpt" class="post-card-excerpt">{{ post.excerpt }}</p>
                <span class="post-card-meta">{{ post.published_date || post.created_date }}</span>
            </div>
        </article>
        <p v-if="!posts.length" class="meta" style="padding: 1.5rem 0;">Chưa có bài viết nào.</p>
    </div>

    <div v-else class="post-list">
        <article v-for="post in posts" :key="post.id" class="post-row">
            <Link :href="`/posts/${post.slug}`" class="post-row-media">
                <img v-if="post.thumbnail_url" :src="post.thumbnail_url" :alt="post.title">
                <div v-else class="post-row-fallback"></div>
            </Link>
            <div class="post-row-body">
                <p class="post-row-meta">{{ post.published_date || post.created_date }}</p>
                <Link class="post-row-title" :href="`/posts/${post.slug}`">{{ post.title }}</Link>
                <p v-if="post.excerpt" class="post-row-excerpt">{{ post.excerpt }}</p>
            </div>
        </article>
        <p v-if="!posts.length" class="meta" style="padding: 1.5rem 0;">Chưa có bài viết nào.</p>
    </div>
</template>
