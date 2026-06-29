<script setup>
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '../../Layouts/PublicLayout.vue';

defineProps({
    seo: Object,
});
</script>

<template>
    <Head :title="seo.title" />
    <PublicLayout>
        <section class="simple-hero">
            <p class="eyebrow">Dịch vụ</p>
            <h1>Hợp tác xây dựng sản phẩm web</h1>
            <p>Tư vấn, thiết kế và phát triển ứng dụng Laravel, hệ thống quản trị nội dung và các workflow phục vụ vận hành.</p>
        </section>

        <div class="work-grid">
            <section class="work-card">
                <div class="work-card-icon">
                    <i class="fas fa-layer-group"></i>
                </div>
                <h3>Laravel Backend</h3>
                <p>Backend, CMS, REST API và tối ưu workflow quản trị. Xây dựng hệ thống bền vững, dễ bảo trì.</p>
            </section>

            <section class="work-card">
                <div class="work-card-icon">
                    <i class="fas fa-code"></i>
                </div>
                <h3>Frontend Vue / Inertia</h3>
                <p>Giao diện hiện đại, hiệu năng cao và dễ bảo trì với Vue 3 và Inertia.js.</p>
            </section>

            <section class="work-card">
                <div class="work-card-icon">
                    <i class="fas fa-server"></i>
                </div>
                <h3>Vận hành hệ thống</h3>
                <p>Triển khai, theo dõi lỗi và cải thiện hiệu năng cho các ứng dụng web production.</p>
            </section>
        </div>

        <div class="work-cta">
            <h3>Bắt đầu một dự án?</h3>
            <p>Gửi cho mình thông tin về dự án và chúng ta sẽ thảo luận thêm.</p>
            <Link href="/contact" class="btn-primary">Liên hệ ngay</Link>
        </div>
    </PublicLayout>
</template>
