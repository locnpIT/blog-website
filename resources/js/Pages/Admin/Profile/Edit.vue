<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

const props = defineProps({ profile: Object });

const form = useForm({
    full_name: props.profile?.full_name || '',
    headline: props.profile?.headline || '',
    email: props.profile?.email || '',
    phone: props.profile?.phone || '',
    address: props.profile?.address || '',
    summary: props.profile?.summary || '',
    skills: props.profile?.skills || '',
    experience: props.profile?.experience || '',
    education: props.profile?.education || '',
    projects: props.profile?.projects || '',
    avatar: null,
    _method: 'put',
});
</script>

<template>
    <Head title="Hồ sơ giới thiệu" />
    <AdminLayout>
        <div class="panel">
            <div class="panel-header">Hồ sơ giới thiệu (CV)</div>
            <div class="panel-body">
                <form @submit.prevent="form.post('/admin/profile', { forceFormData: true })">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Ảnh đại diện</label>
                            <input type="file" class="form-control" :class="{ 'is-invalid': form.errors.avatar }" @input="form.avatar = $event.target.files[0]">
                            <div v-if="form.errors.avatar" class="invalid-feedback">{{ form.errors.avatar }}</div>
                            <div v-if="profile?.avatar_url" class="mt-3"><img :src="profile.avatar_url" alt="avatar" width="140" style="border-radius:12px;object-fit:cover;border:1px solid rgba(0,0,0,.08);"></div>
                        </div>
                        <div class="col-md-6"><label class="form-label">Họ và tên</label><input v-model="form.full_name" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Tiêu đề nghề nghiệp</label><input v-model="form.headline" class="form-control"></div>
                        <div class="col-md-4"><label class="form-label">Email</label><input v-model="form.email" class="form-control" :class="{ 'is-invalid': form.errors.email }"><div v-if="form.errors.email" class="invalid-feedback">{{ form.errors.email }}</div></div>
                        <div class="col-md-4"><label class="form-label">Số điện thoại</label><input v-model="form.phone" class="form-control"></div>
                        <div class="col-md-4"><label class="form-label">Địa chỉ</label><input v-model="form.address" class="form-control"></div>
                        <div class="col-12"><label class="form-label">Tóm tắt bản thân</label><textarea v-model="form.summary" rows="4" class="form-control"></textarea></div>
                        <div class="col-12"><label class="form-label">Kỹ năng</label><textarea v-model="form.skills" rows="6" class="form-control"></textarea></div>
                        <div class="col-12"><label class="form-label">Kinh nghiệm làm việc</label><textarea v-model="form.experience" rows="8" class="form-control"></textarea></div>
                        <div class="col-12"><label class="form-label">Học vấn</label><textarea v-model="form.education" rows="6" class="form-control"></textarea></div>
                        <div class="col-12"><label class="form-label">Dự án nổi bật</label><textarea v-model="form.projects" rows="8" class="form-control"></textarea></div>
                    </div>
                    <button class="btn btn-dark mt-3" :disabled="form.processing">Lưu hồ sơ</button>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
