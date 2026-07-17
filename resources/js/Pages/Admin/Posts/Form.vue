<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { Ckeditor } from '@ckeditor/ckeditor5-vue';
import {
    BlockQuote,
    Bold,
    ClassicEditor,
    Code,
    CodeBlock,
    Essentials,
    Heading,
    Italic,
    Link,
    List,
    Paragraph,
    Table,
    TableToolbar,
    Undo,
} from 'ckeditor5';
import 'ckeditor5/ckeditor5.css';
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

const editorConfig = {
    licenseKey: 'GPL',
    plugins: [
        BlockQuote,
        Bold,
        Code,
        CodeBlock,
        Essentials,
        Heading,
        Italic,
        Link,
        List,
        Paragraph,
        Table,
        TableToolbar,
        Undo,
    ],
    toolbar: [
        'undo',
        'redo',
        '|',
        'heading',
        '|',
        'bold',
        'italic',
        'code',
        'link',
        '|',
        'bulletedList',
        'numberedList',
        'blockQuote',
        'codeBlock',
        '|',
        'insertTable',
    ],
    heading: {
        options: [
            { model: 'paragraph', title: 'Đoạn văn', class: 'ck-heading_paragraph' },
            { model: 'heading2', view: 'h2', title: 'Tiêu đề H2', class: 'ck-heading_heading2' },
            { model: 'heading3', view: 'h3', title: 'Tiêu đề H3', class: 'ck-heading_heading3' },
            { model: 'heading4', view: 'h4', title: 'Tiêu đề H4', class: 'ck-heading_heading4' },
        ],
    },
    table: {
        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells'],
    },
};

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
                            <Ckeditor
                                v-model="form.content"
                                :editor="ClassicEditor"
                                :config="editorConfig"
                                :class="{ 'is-invalid': form.errors.content }"
                            />
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
