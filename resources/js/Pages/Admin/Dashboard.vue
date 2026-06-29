<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';

defineProps({
    totalPosts: Number,
    publishedPosts: Number,
    draftPosts: Number,
    newContacts: Number,
    siteTitle: String,
});
</script>

<template>
    <Head title="Quản trị" />
    <AdminLayout>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Tổng quan hệ thống</h2>
                <p class="meta mb-0">Theo dõi nhanh hiệu suất nội dung và trạng thái hệ thống CMS.</p>
            </div>
            <Link href="/admin/posts/create" class="btn btn-dark">Tạo bài viết mới</Link>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-md-6 col-xl-3"><div class="stat-card"><div class="stat-label">Tổng bài viết</div><div class="stat-value">{{ totalPosts }}</div></div></div>
            <div class="col-md-6 col-xl-3"><div class="stat-card"><div class="stat-label">Đã xuất bản</div><div class="stat-value">{{ publishedPosts }}</div></div></div>
            <div class="col-md-6 col-xl-3"><div class="stat-card"><div class="stat-label">Bản nháp</div><div class="stat-value">{{ draftPosts }}</div></div></div>
            <div class="col-md-6 col-xl-3"><div class="stat-card"><div class="stat-label">Liên hệ mới</div><div class="stat-value">{{ newContacts }}</div></div></div>
        </div>
        <div class="panel">
            <div class="panel-header">Trạng thái hệ thống</div>
            <div class="panel-body">
                <p class="mb-2"><strong>Website:</strong> {{ siteTitle }}</p>
                <p class="meta mb-0">Hệ thống đã sẵn sàng để quản lý nội dung, phản hồi liên hệ và cập nhật cấu hình website.</p>
            </div>
        </div>
    </AdminLayout>
</template>
