<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '../../Layouts/PublicLayout.vue';
import PostList from '../../Components/PostList.vue';
import SidebarCards from '../../Components/SidebarCards.vue';

defineProps({
    post: Object,
    relatedPosts: Array,
    sidebarCategories: Array,
    seo: Object,
});
</script>

<template>
    <Head :title="seo.title" />
    <PublicLayout>
        <div class="content-layout">
            <article class="post-page">
                <div class="post-meta">
                    <span v-if="post.category?.name">{{ post.category.name }}</span>
                    <span v-if="post.category?.name" class="post-meta-dot"></span>
                    <span>{{ post.published_datetime }}</span>
                </div>
                <h1 class="post-page-title">{{ post.title }}</h1>
                <p v-if="post.excerpt" class="post-page-subtitle">{{ post.excerpt }}</p>
                <div v-if="post.thumbnail_url" class="post-page-image">
                    <img :src="post.thumbnail_url" :alt="post.title">
                </div>
                <div class="post-page-content" v-html="post.content"></div>
            </article>

            <aside class="home-sidebar">
                <SidebarCards :categories="sidebarCategories" />
            </aside>
        </div>

        <section v-if="relatedPosts?.length" class="related-simple">
            <h2 class="section-title">Bài viết liên quan</h2>
            <PostList :posts="relatedPosts" layout="list" />
        </section>
    </PublicLayout>
</template>
