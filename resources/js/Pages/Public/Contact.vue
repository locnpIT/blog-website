<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import PublicLayout from '../../Layouts/PublicLayout.vue';

defineProps({
    seo: Object,
});

const form = useForm({
    name: '',
    email: '',
    subject: '',
    message: '',
});

const submit = () => form.post('/contact', {
    preserveScroll: true,
    onSuccess: () => form.reset(),
});
</script>

<template>
    <Head :title="seo.title" />
    <PublicLayout>
        <section class="simple-hero simple-hero-tight">
            <p class="eyebrow">Liên hệ</p>
            <h1>Gửi lời nhắn cho mình</h1>
            <p>Nếu bạn có câu hỏi hoặc muốn trao đổi về hợp tác, đừng ngần ngại liên hệ nhé.</p>
        </section>

        <div class="contact-simple">
            <div class="simple-card">
                <form @submit.prevent="submit">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Họ tên</label>
                            <input
                                v-model="form.name"
                                type="text"
                                class="form-control"
                                :class="{ 'is-invalid': form.errors.name }"
                                placeholder="Nguyễn Văn A"
                            >
                            <div v-if="form.errors.name" class="invalid-feedback">{{ form.errors.name }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input
                                v-model="form.email"
                                type="email"
                                class="form-control"
                                :class="{ 'is-invalid': form.errors.email }"
                                placeholder="email@example.com"
                            >
                            <div v-if="form.errors.email" class="invalid-feedback">{{ form.errors.email }}</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tiêu đề</label>
                            <input
                                v-model="form.subject"
                                type="text"
                                class="form-control"
                                :class="{ 'is-invalid': form.errors.subject }"
                                placeholder="Chủ đề bạn muốn trao đổi"
                            >
                            <div v-if="form.errors.subject" class="invalid-feedback">{{ form.errors.subject }}</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Nội dung</label>
                            <textarea
                                v-model="form.message"
                                rows="7"
                                class="form-control"
                                :class="{ 'is-invalid': form.errors.message }"
                                placeholder="Mô tả ngắn gọn nội dung bạn muốn chia sẻ..."
                            ></textarea>
                            <div v-if="form.errors.message" class="invalid-feedback">{{ form.errors.message }}</div>
                        </div>
                    </div>
                    <button class="btn-primary mt-3" type="submit" :disabled="form.processing">
                        {{ form.processing ? 'Đang gửi...' : 'Gửi lời nhắn' }}
                    </button>
                </form>
            </div>

            <aside class="contact-aside">
                <div class="simple-card">
                    <div class="contact-info-item">
                        <p class="contact-info-label">Thời gian phản hồi</p>
                        <p class="contact-info-value">Trong vòng 24 giờ</p>
                    </div>
                    <div class="contact-info-item">
                        <p class="contact-info-label">Nội dung phù hợp</p>
                        <p class="contact-info-value">Hợp tác, góp ý, câu hỏi kỹ thuật</p>
                    </div>
                    <div class="contact-info-item">
                        <p class="contact-info-label">Lưu ý</p>
                        <p class="contact-info-value">Vui lòng ghi rõ ngữ cảnh để mình hỗ trợ tốt hơn.</p>
                    </div>
                </div>
            </aside>
        </div>
    </PublicLayout>
</template>
