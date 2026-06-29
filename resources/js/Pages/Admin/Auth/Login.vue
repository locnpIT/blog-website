<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => form.post('/login');
</script>

<template>
    <Head title="Đăng nhập CMS" />
    <div class="d-flex align-items-center" style="min-height:100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="panel">
                        <div class="panel-header">Đăng nhập quản trị</div>
                        <div class="panel-body">
                            <p class="meta mb-3">Sử dụng tài khoản admin để truy cập CMS.</p>
                            <form @submit.prevent="submit">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input v-model="form.email" class="form-control" :class="{ 'is-invalid': form.errors.email }">
                                    <div v-if="form.errors.email" class="invalid-feedback">{{ form.errors.email }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mật khẩu</label>
                                    <input v-model="form.password" type="password" class="form-control" :class="{ 'is-invalid': form.errors.password }">
                                    <div v-if="form.errors.password" class="invalid-feedback">{{ form.errors.password }}</div>
                                </div>
                                <button class="btn btn-dark w-100" :disabled="form.processing">Đăng nhập</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
