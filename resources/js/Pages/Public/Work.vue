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
        <section class="work-hero">
            <div class="work-hero-copy">
                <p class="eyebrow">Dịch vụ</p>
                <h1>Hợp tác xây dựng sản phẩm web rõ ràng, gọn gàng, dễ vận hành</h1>
                <p class="work-hero-description">
                    Tư vấn, thiết kế và phát triển ứng dụng Java, Spring Boot, hệ thống quản trị nội dung
                    và các workflow phục vụ vận hành. Mục tiêu là giao diện sạch, luồng làm việc rõ và
                    đủ linh hoạt để phát triển lâu dài.
                </p>
                <div class="hero-actions">
                    <Link class="btn-primary" href="/contact">Bắt đầu dự án</Link>
                    <Link class="btn-ghost" href="/about">Xem thêm về tôi</Link>
                </div>
                <div class="work-hero-points">
                    <div class="work-point">
                        <span>01</span>
                        <p>Backend Spring Boot, REST API, phân quyền và luồng quản trị.</p>
                    </div>
                    <div class="work-point">
                        <span>02</span>
                        <p>Frontend rõ bố cục, ưu tiên tốc độ đọc và thao tác nhanh.</p>
                    </div>
                    <div class="work-point">
                        <span>03</span>
                        <p>Triển khai, tối ưu và bảo trì để hệ thống đi đường dài.</p>
                    </div>
                </div>
            </div>

            <div class="work-hero-visual">
                <div class="work-hero-image-shell">
                    <div
                        class="work-hero-image"
                        :style="{ backgroundImage: 'url(/images/HeroBannerForWork.png)' }"
                        aria-hidden="true"
                    ></div>
                </div>
            </div>
        </section>

        <section class="work-section">
            <div class="work-section-header">
                <p class="eyebrow">Năng lực</p>
                <h2>Các hướng triển khai thường làm</h2>
            </div>

            <div class="work-grid">
                <section class="work-card">
                    <span class="work-card-kicker">01</span>
                    <h3>Java Backend</h3>
                    <p>Spring Boot, REST API, CMS và tối ưu workflow quản trị. Xây dựng hệ thống bền vững, dễ bảo trì.</p>
                </section>

                <section class="work-card">
                    <span class="work-card-kicker">02</span>
                    <h3>Frontend tích hợp API</h3>
                    <p>Giao diện hiện đại, ưu tiên nhịp đọc và thao tác, kết nối mượt với backend Java qua REST API.</p>
                </section>

                <section class="work-card">
                    <span class="work-card-kicker">03</span>
                    <h3>Vận hành hệ thống</h3>
                    <p>Triển khai, theo dõi lỗi và cải thiện hiệu năng cho các ứng dụng web production.</p>
                </section>
            </div>
        </section>

        <div class="work-cta">
            <h3>Bắt đầu một dự án?</h3>
            <p>Gửi cho mình thông tin về dự án, bối cảnh sử dụng và những gì bạn muốn ưu tiên.</p>
            <Link href="/contact" class="btn-primary">Liên hệ ngay</Link>
        </div>
    </PublicLayout>
</template>
