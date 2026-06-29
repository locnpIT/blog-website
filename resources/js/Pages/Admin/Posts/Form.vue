<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

const props = defineProps({
    post: {
        type: Object,
        default: null,
    },
    categories: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    title: props.post?.title || '',
    excerpt: props.post?.excerpt || '',
    content: props.post?.content || '',
    category_id: props.post?.category_id || props.categories[0]?.id || '',
    status: props.post?.status || 'draft',
    thumbnail: null,
    _method: props.post ? 'put' : undefined,
});

const submit = () => {
    if (props.post) {
        form.post(`/admin/posts/${props.post.id}`, { forceFormData: true });
        return;
    }
    form.post('/admin/posts', { forceFormData: true });
};
</script>

<template>
    <Head :title="post ? 'Sửa bài viết' : 'Thêm bài viết'" />
    <AdminLayout>
        <div class="panel">
            <div class="panel-header">{{ post ? 'Sửa bài viết' : 'Thêm bài viết' }}</div>
            <div class="panel-body">
                <form @submit.prevent="submit">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Tiêu đề</label>
                            <input v-model="form.title" class="form-control" :class="{ 'is-invalid': form.errors.title }">
                            <div v-if="form.errors.title" class="invalid-feedback">{{ form.errors.title }}</div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Danh mục</label>
                            <select v-model="form.category_id" class="form-select" :class="{ 'is-invalid': form.errors.category_id }">
                                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                            </select>
                            <div v-if="form.errors.category_id" class="invalid-feedback">{{ form.errors.category_id }}</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Mô tả ngắn</label>
                            <textarea v-model="form.excerpt" rows="3" class="form-control" :class="{ 'is-invalid': form.errors.excerpt }"></textarea>
                            <div v-if="form.errors.excerpt" class="invalid-feedback">{{ form.errors.excerpt }}</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Nội dung</label>
                            <textarea v-model="form.content" class="form-control" rows="14" :class="{ 'is-invalid': form.errors.content }"></textarea>
                            <div v-if="form.errors.content" class="invalid-feedback">{{ form.errors.content }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" class="form-control" :class="{ 'is-invalid': form.errors.thumbnail }" @input="form.thumbnail = $event.target.files[0]">
                            <div v-if="form.errors.thumbnail" class="invalid-feedback">{{ form.errors.thumbnail }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Trạng thái</label>
                            <select v-model="form.status" class="form-select">
                                <option value="draft">draft</option>
                                <option value="published">published</option>
                            </select>
                        </div>
                    </div>
                    <div v-if="post?.thumbnail_url" class="mt-3">
                        <img :src="post.thumbnail_url" width="140" alt="thumbnail">
                    </div>
                    <button class="btn btn-dark mt-3" :disabled="form.processing">{{ post ? 'Cập nhật' : 'Lưu' }}</button>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
