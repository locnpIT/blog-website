<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '../../Layouts/PublicLayout.vue';
import Pagination from '../../Components/Pagination.vue';
import PostList from '../../Components/PostList.vue';
import SidebarCards from '../../Components/SidebarCards.vue';

defineProps({
    category: Object,
    posts: Object,
    profile: Object,
    sidebarCategories: Array,
    seo: Object,
});
</script>

<template>
    <Head :title="seo.title" />
    <PublicLayout>
        <section class="simple-hero simple-hero-tight">
            <p class="eyebrow">Danh mục</p>
            <h1>{{ category.name }}</h1>
            <p v-if="category.description">{{ category.description }}</p>
        </section>

        <div class="home-content">
            <section class="section-block">
                <PostList :posts="posts.data" />
                <Pagination :links="posts.links" />
            </section>
            <aside class="home-sidebar">
                <SidebarCards :profile="profile" :categories="sidebarCategories" />
            </aside>
        </div>
    </PublicLayout>
</template>
