<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const menuOpen = ref(false);

const isActive = (path) => page.url.split('?')[0] === path;
const closeMenu = () => { menuOpen.value = false; };
</script>

<template>
    <div class="app-shell">
        <nav class="topbar">
            <div class="container">
                <div class="navbar-inner">
                    <Link class="brand" href="/" :aria-label="page.props.globalSettings.site_title || 'PhuocLocBlog'">
                        <img :src="'/images/PhuocLocBlogLogoHeader.png'" :alt="page.props.globalSettings.site_title || 'PhuocLocBlog'">
                    </Link>

                    <button class="nav-toggle" @click="menuOpen = !menuOpen" :aria-expanded="menuOpen" aria-label="Mở menu">
                        <i :class="menuOpen ? 'fas fa-times' : 'fas fa-bars'"></i>
                    </button>

                    <div class="nav-links-wrap" :class="{ 'is-open': menuOpen }">
                        <ul class="nav-links">
                            <li><Link class="nav-link" :class="{ active: isActive('/') }" href="/" @click="closeMenu">Trang chủ</Link></li>
                            <li><Link class="nav-link" :class="{ active: isActive('/about') }" href="/about" @click="closeMenu">Giới thiệu</Link></li>
                            <li><Link class="nav-link" :class="{ active: isActive('/work') }" href="/work" @click="closeMenu">Làm việc</Link></li>
                            <li><Link class="nav-link" :class="{ active: isActive('/contact') }" href="/contact" @click="closeMenu">Liên hệ</Link></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <main class="page-wrap">
            <div v-if="page.props.flash?.success" class="container">
                <div class="alert alert-success mt-3">{{ page.props.flash.success }}</div>
            </div>
            <div class="container">
                <slot />
            </div>
        </main>

        <footer class="main-footer">
            <div class="container footer-wrap">
                <div class="footer-grid">
                    <section class="footer-brand-block">
                        <img class="footer-logo" :src="'/images/PhuocLocBlogLogoHeader.png'" :alt="page.props.globalSettings.site_title || 'PhuocLocBlog'">
                        <p class="footer-bio">{{ page.props.globalSettings.author_bio || 'Blog chia sẻ về đời sống hằng ngày, kiến thức lập trình, hệ thống web và kinh nghiệm kỹ thuật thực chiến.' }}</p>
                    </section>

                    <section class="footer-links-block">
                        <h3>Điều hướng</h3>
                        <Link href="/">Trang chủ</Link>
                        <Link href="/about">Giới thiệu</Link>
                        <Link href="/work">Làm việc</Link>
                        <Link href="/contact">Liên hệ</Link>
                    </section>

                    <section class="footer-contact-block">
                        <h3>Kết nối</h3>
                        <div class="footer-social-row">
                            <a v-if="page.props.globalSettings.social_facebook" :href="page.props.globalSettings.social_facebook" target="_blank" rel="noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a v-if="page.props.globalSettings.social_instagram" :href="page.props.globalSettings.social_instagram" target="_blank" rel="noreferrer" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a v-if="page.props.globalSettings.social_linkedin" :href="page.props.globalSettings.social_linkedin" target="_blank" rel="noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a v-if="page.props.globalSettings.social_github" :href="page.props.globalSettings.social_github" target="_blank" rel="noreferrer" aria-label="GitHub"><i class="fab fa-github"></i></a>
                        </div>
                        <Link class="footer-contact-link" href="/contact">Gửi lời nhắn →</Link>
                    </section>
                </div>

                <div class="footer-bottom">
                    <span>© {{ new Date().getFullYear() }} {{ page.props.globalSettings.site_title || 'PhuocLocBlog' }}</span>
                    <span>{{ page.props.globalSettings.author_name || 'Nguyễn Phước Lộc' }}</span>
                </div>
            </div>
        </footer>
    </div>
</template>
