<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

const props = defineProps({
    settings: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    site_title: props.settings.site_title || '',
    author_name: props.settings.author_name || '',
    author_bio: props.settings.author_bio || '',
    social_facebook: props.settings.social_facebook || '',
    social_instagram: props.settings.social_instagram || '',
    social_linkedin: props.settings.social_linkedin || '',
    social_github: props.settings.social_github || '',
});
</script>

<template>
    <Head title="Cài đặt website" />
    <AdminLayout>
        <div class="card p-4">
            <h4 class="mb-3">Cài đặt website</h4>
            <form @submit.prevent="form.put('/admin/settings')">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Site title</label><input v-model="form.site_title" class="form-control"></div>
                    <div class="col-md-6"><label class="form-label">Tên tác giả</label><input v-model="form.author_name" class="form-control"></div>
                    <div class="col-12"><label class="form-label">Bio</label><textarea v-model="form.author_bio" class="form-control" rows="3"></textarea></div>
                    <div class="col-md-3"><label class="form-label">Facebook</label><input v-model="form.social_facebook" class="form-control" :class="{ 'is-invalid': form.errors.social_facebook }"><div v-if="form.errors.social_facebook" class="invalid-feedback">{{ form.errors.social_facebook }}</div></div>
                    <div class="col-md-3"><label class="form-label">Instagram</label><input v-model="form.social_instagram" class="form-control" :class="{ 'is-invalid': form.errors.social_instagram }"><div v-if="form.errors.social_instagram" class="invalid-feedback">{{ form.errors.social_instagram }}</div></div>
                    <div class="col-md-3"><label class="form-label">LinkedIn</label><input v-model="form.social_linkedin" class="form-control" :class="{ 'is-invalid': form.errors.social_linkedin }"><div v-if="form.errors.social_linkedin" class="invalid-feedback">{{ form.errors.social_linkedin }}</div></div>
                    <div class="col-md-3"><label class="form-label">GitHub</label><input v-model="form.social_github" class="form-control" :class="{ 'is-invalid': form.errors.social_github }"><div v-if="form.errors.social_github" class="invalid-feedback">{{ form.errors.social_github }}</div></div>
                </div>
                <button class="btn btn-dark mt-3" :disabled="form.processing">Lưu cài đặt</button>
            </form>
        </div>
    </AdminLayout>
</template>
