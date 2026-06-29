<script setup>
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import Pagination from '../../../Components/Pagination.vue';

defineProps({ contacts: Object });
</script>

<template>
    <Head title="Liên hệ" />
    <AdminLayout>
        <div class="panel">
            <div class="panel-header">Hộp thư liên hệ</div>
            <div class="panel-body">
                <div class="row g-3">
                    <div v-for="contact in contacts.data" :key="contact.id" class="col-xl-6">
                        <div class="card p-3 h-100">
                            <div class="d-flex justify-content-between align-items-start">
                                <strong>{{ contact.subject }}</strong>
                                <span class="badge" :class="contact.is_read ? 'text-bg-secondary' : 'text-bg-danger'">{{ contact.is_read ? 'Đã đọc' : 'Mới' }}</span>
                            </div>
                            <div class="meta mt-1">{{ contact.name }} • {{ contact.email }}</div>
                            <p class="mt-2 mb-2">{{ contact.message }}</p>
                            <small class="meta">IP: {{ contact.ip_address }} • {{ contact.created_at_formatted }}</small>
                            <div class="mt-3 d-flex gap-2">
                                <button v-if="!contact.is_read" class="btn btn-sm btn-outline-primary" @click="router.patch(`/admin/contacts/${contact.id}/read`)">Đánh dấu đã đọc</button>
                                <button class="btn btn-sm btn-outline-danger" @click="confirm('Xóa liên hệ?') && router.delete(`/admin/contacts/${contact.id}`)">Xóa</button>
                            </div>
                        </div>
                    </div>
                    <div v-if="!contacts.data.length" class="col-12"><div class="card p-4 text-center text-muted">Không có liên hệ</div></div>
                </div>
            </div>
        </div>
        <div class="mt-3"><Pagination :links="contacts.links" /></div>
    </AdminLayout>
</template>
