<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import Pagination from '../../../Components/Pagination.vue';

defineProps({ categories: Object });

const destroyCategory = (id) => {
    if (confirm('Xóa danh mục?')) router.delete(`/admin/categories/${id}`);
};
</script>

<template>
    <Head title="Danh mục" />
    <AdminLayout>
        <div class="panel overflow-hidden">
            <div class="panel-header d-flex justify-content-between align-items-center">
                <span>Quản lý danh mục</span>
                <Link class="btn btn-dark btn-sm" href="/admin/categories/create">Thêm danh mục</Link>
            </div>
            <div class="panel-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead><tr><th>Tên</th><th>Slug</th><th>Số bài viết</th><th class="text-end">Thao tác</th></tr></thead>
                        <tbody>
                            <tr v-for="category in categories.data" :key="category.id">
                                <td class="fw-semibold">{{ category.name }}</td>
                                <td class="text-muted">{{ category.slug }}</td>
                                <td>{{ category.posts_count }}</td>
                                <td class="text-end">
                                    <Link class="btn btn-sm btn-outline-secondary" :href="`/admin/categories/${category.id}/edit`">Sửa</Link>
                                    <button class="btn btn-sm btn-outline-danger ms-1" @click="destroyCategory(category.id)">Xóa</button>
                                </td>
                            </tr>
                            <tr v-if="!categories.data.length"><td colspan="4" class="text-center py-4 text-muted">Chưa có dữ liệu</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-3"><Pagination :links="categories.links" /></div>
    </AdminLayout>
</template>
