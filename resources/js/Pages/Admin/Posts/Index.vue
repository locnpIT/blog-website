<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import Pagination from '../../../Components/Pagination.vue';

defineProps({ posts: Object });

const destroyPost = (id) => {
    if (confirm('Xóa bài viết?')) router.delete(`/admin/posts/${id}`);
};
</script>

<template>
    <Head title="Bài viết" />
    <AdminLayout>
        <div class="panel overflow-hidden">
            <div class="panel-header d-flex justify-content-between align-items-center">
                <span>Quản lý bài viết</span>
                <Link class="btn btn-dark btn-sm" href="/admin/posts/create">Thêm bài viết</Link>
            </div>
            <div class="panel-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead><tr><th style="min-width:90px">Ảnh</th><th>Tiêu đề</th><th>Danh mục</th><th>Trạng thái</th><th class="text-end">Thao tác</th></tr></thead>
                        <tbody>
                            <tr v-for="post in posts.data" :key="post.id">
                                <td><img v-if="post.thumbnail_url" :src="post.thumbnail_url" width="78" height="54" style="object-fit:cover;border:1px solid rgba(0,0,0,.1)" alt="thumb"></td>
                                <td><div class="fw-semibold">{{ post.title }}</div><small class="text-muted">{{ post.slug }}</small></td>
                                <td>{{ post.category?.name }}</td>
                                <td><span class="badge" :class="post.status === 'published' ? 'text-bg-success' : 'text-bg-secondary'">{{ post.status }}</span></td>
                                <td class="text-end">
                                    <Link class="btn btn-sm btn-outline-secondary" :href="`/admin/posts/${post.id}/edit`">Sửa</Link>
                                    <button class="btn btn-sm btn-outline-danger ms-1" @click="destroyPost(post.id)">Xóa</button>
                                </td>
                            </tr>
                            <tr v-if="!posts.data.length"><td colspan="5" class="text-center py-4 text-muted">Chưa có dữ liệu</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-3"><Pagination :links="posts.links" /></div>
    </AdminLayout>
</template>
