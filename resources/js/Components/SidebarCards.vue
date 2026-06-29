<script setup>
import { Link, usePage } from '@inertiajs/vue3';

defineProps({
    profile: {
        type: Object,
        default: null,
    },
    categories: {
        type: Array,
        default: () => [],
    },
});

const page = usePage();
</script>

<template>
    <div v-if="profile" class="sidebar-card">
        <img v-if="profile.avatar_url" :src="profile.avatar_url" :alt="profile.full_name" class="sidebar-avatar">
        <p class="sidebar-name">{{ profile.full_name || page.props.globalSettings?.author_name || 'Phuoc Loc' }}</p>
        <p class="sidebar-bio">{{ profile.headline || profile.summary }}</p>
    </div>

    <div v-if="categories.length" class="sidebar-card">
        <h3>Danh mục</h3>
        <ul class="sidebar-cat-list">
            <li v-for="category in categories" :key="category.id">
                <Link class="sidebar-cat-item" :href="`/categories/${category.slug}`">
                    <span>{{ category.name }}</span>
                    <span class="sidebar-cat-count">{{ category.posts_count ?? 0 }}</span>
                </Link>
            </li>
        </ul>
    </div>

    <div class="sidebar-card">
        <h3>Kết nối</h3>
        <div class="sidebar-social">
            <a v-if="page.props.globalSettings?.social_facebook" :href="page.props.globalSettings.social_facebook" target="_blank" rel="noreferrer" aria-label="Facebook" class="sidebar-social-link">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a v-if="page.props.globalSettings?.social_instagram" :href="page.props.globalSettings.social_instagram" target="_blank" rel="noreferrer" aria-label="Instagram" class="sidebar-social-link">
                <i class="fab fa-instagram"></i>
            </a>
            <a v-if="page.props.globalSettings?.social_linkedin" :href="page.props.globalSettings.social_linkedin" target="_blank" rel="noreferrer" aria-label="LinkedIn" class="sidebar-social-link">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a v-if="page.props.globalSettings?.social_github" :href="page.props.globalSettings.social_github" target="_blank" rel="noreferrer" aria-label="GitHub" class="sidebar-social-link">
                <i class="fab fa-github"></i>
            </a>
        </div>
    </div>
</template>
