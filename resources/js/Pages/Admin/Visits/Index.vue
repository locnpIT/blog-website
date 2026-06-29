<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import Pagination from '../../../Components/Pagination.vue';

const props = defineProps({
    visits: Object,
    totalVisits: Number,
    todayVisits: Number,
    filters: Object,
});

const form = reactive({
    from_date: props.filters?.from_date || '',
    to_date: props.filters?.to_date || '',
});

const submit = () => router.get('/admin/visits', form, { preserveState: true });
</script>

<template>
    <Head title="Lượt truy cập" />
    <AdminLayout>
        <div class="d-flex justify-content-between align-items-center mb-3"><h4 class="mb-0">Thống kê lượt truy cập theo ngày</h4></div>
        <div class="row g-3 mb-3">
            <div class="col-md-4"><div class="stat-card"><div class="stat-label">Lượt truy cập hôm nay</div><div class="stat-value">{{ todayVisits.toLocaleString() }}</div></div></div>
            <div class="col-md-4"><div class="stat-card"><div class="stat-label">Tổng lượt trong danh sách</div><div class="stat-value">{{ totalVisits.toLocaleString() }}</div></div></div>
        </div>
        <div class="panel mb-3">
            <div class="panel-body">
                <form class="row g-2 align-items-end" @submit.prevent="submit">
                    <div class="col-md-3"><label class="form-label">Từ ngày</label><input v-model="form.from_date" type="date" class="form-control"></div>
                    <div class="col-md-3"><label class="form-label">Đến ngày</label><input v-model="form.to_date" type="date" class="form-control"></div>
                    <div class="col-md-3 d-flex gap-2"><button class="btn btn-dark">Lọc</button><Link href="/admin/visits" class="btn btn-light border">Đặt lại</Link></div>
                </form>
            </div>
        </div>
        <div class="panel overflow-hidden">
            <div class="panel-header">Danh sách theo ngày</div>
            <div class="panel-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead><tr><th>Ngày</th><th class="text-end">Lượt truy cập</th></tr></thead>
                        <tbody>
                            <tr v-for="visit in visits.data" :key="visit.id">
                                <td>{{ visit.visit_date_formatted }}</td>
                                <td class="text-end fw-semibold">{{ visit.visit_count.toLocaleString() }}</td>
                            </tr>
                            <tr v-if="!visits.data.length"><td colspan="2" class="text-center text-muted py-4">Chưa có dữ liệu truy cập</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-3"><Pagination :links="visits.links" /></div>
    </AdminLayout>
</template>
