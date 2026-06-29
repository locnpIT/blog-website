<script setup>
import { Head } from '@inertiajs/vue3';
import PublicLayout from '../../Layouts/PublicLayout.vue';

defineProps({
    profile: Object,
    seo: Object,
});
</script>

<template>
    <Head :title="seo.title" />
    <PublicLayout>
        <section class="simple-hero">
            <p class="eyebrow">Giới thiệu</p>
            <h1>{{ profile?.full_name || 'Nguyễn Phước Lộc' }}</h1>
            <p v-if="profile?.headline">{{ profile.headline }}</p>
        </section>

        <div class="about-profile-section">
            <div class="about-avatar-card">
                <img
                    v-if="profile?.avatar_url"
                    :src="profile.avatar_url"
                    :alt="profile.full_name"
                    class="about-avatar-img"
                >
                <p class="about-avatar-name">{{ profile?.full_name }}</p>
                <p class="about-avatar-title">{{ profile?.headline }}</p>
            </div>

            <div class="about-content-card">
                <div class="article-content" v-if="profile?.summary" v-html="profile.summary"></div>

                <template v-if="profile?.skills">
                    <h3>Kỹ năng</h3>
                    <div class="article-content" v-html="profile.skills"></div>
                </template>

                <template v-if="profile?.experience">
                    <h3>Kinh nghiệm làm việc</h3>
                    <div class="article-content" v-html="profile.experience"></div>
                </template>

                <template v-if="profile?.education">
                    <h3>Học vấn</h3>
                    <div class="article-content" v-html="profile.education"></div>
                </template>
            </div>
        </div>
    </PublicLayout>
</template>
