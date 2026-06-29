<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

const props = defineProps({
    category: {
        type: Object,
        default: null,
    },
});

const form = useForm({
    name: props.category?.name || '',
    slug: props.category?.slug || '',
    description: props.category?.description || '',
});

const slugify = () => {
    form.slug = form.name.toLowerCase().trim().normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .replace(/[đĐ]/g, 'd')
        .replace(/([^0-9a-z-\s])/g, '')
        .replace(/(\s+)/g, '-')
        .replace(/-+/g, '-')
        .replace(/^-+|-+$/g, '');
};

const submit = () => {
    if (props.category) {
        form.put(`/admin/categories/${props.category.id}`);
        return;
    }
    form.post('/admin/categories');
};
</script>

<template>
    <Head :title="category ? 'Sửa danh mục' : 'Thêm danh mục'" />
    <AdminLayout>
        <div class="panel">
            <div class="panel-header">{{ category ? 'Sửa danh mục' : 'Thêm danh mục' }}</div>
            <div class="panel-body">
                <form @submit.prevent="submit">
                    <div class="mb-3">
                        <label class="form-label">Tên</label>
                        <input v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.name }" @input="slugify">
                        <div v-if="form.errors.name" class="invalid-feedback">{{ form.errors.name }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug (Đường dẫn tĩnh)</label>
                        <input v-model="form.slug" class="form-control" :class="{ 'is-invalid': form.errors.slug }">
                        <small class="text-muted">Slug sẽ được tự động tạo từ tên nếu để trống.</small>
                        <div v-if="form.errors.slug" class="invalid-feedback">{{ form.errors.slug }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea v-model="form.description" class="form-control" rows="4" :class="{ 'is-invalid': form.errors.description }"></textarea>
                        <div v-if="form.errors.description" class="invalid-feedback">{{ form.errors.description }}</div>
                    </div>
                    <button class="btn btn-dark" :disabled="form.processing">{{ category ? 'Cập nhật' : 'Lưu' }}</button>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
