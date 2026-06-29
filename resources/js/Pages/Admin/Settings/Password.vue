<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});
</script>

<template>
    <Head title="Đổi mật khẩu" />
    <AdminLayout>
        <div class="card p-4" style="max-width:600px;">
            <h4 class="mb-3">Đổi mật khẩu</h4>
            <form @submit.prevent="form.put('/admin/security/password')">
                <div class="mb-3">
                    <label class="form-label">Mật khẩu hiện tại</label>
                    <input v-model="form.current_password" type="password" class="form-control" :class="{ 'is-invalid': form.errors.current_password }">
                    <div v-if="form.errors.current_password" class="invalid-feedback">{{ form.errors.current_password }}</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mật khẩu mới</label>
                    <input v-model="form.password" type="password" class="form-control" :class="{ 'is-invalid': form.errors.password }">
                    <div v-if="form.errors.password" class="invalid-feedback">{{ form.errors.password }}</div>
                </div>
                <div class="mb-3"><label class="form-label">Nhập lại mật khẩu mới</label><input v-model="form.password_confirmation" type="password" class="form-control"></div>
                <button class="btn btn-dark" :disabled="form.processing">Cập nhật</button>
            </form>
        </div>
    </AdminLayout>
</template>
