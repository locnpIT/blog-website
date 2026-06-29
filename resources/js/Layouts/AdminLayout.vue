<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';

const page = usePage();
const currentPath = () => page.url.split('?')[0];
const isActive = (prefix) => currentPath().startsWith(prefix);
const logout = () => router.post('/logout');
</script>

<template>
    <div class="app-shell">
        <nav class="navbar navbar-expand-lg topbar py-3">
            <div class="container-fluid px-4">
                <Link class="navbar-brand brand" href="/admin">PhuocLocBlog CMS</Link>
                <div class="d-flex gap-2">
                    <Link href="/" class="btn btn-light border btn-sm">Xem trang web</Link>
                    <button class="btn btn-dark btn-sm" type="button" @click="logout">Đăng xuất</button>
                </div>
            </div>
        </nav>

        <main class="container-fluid px-4 py-4">
            <div v-if="page.props.flash.success" class="alert alert-success">{{ page.props.flash.success }}</div>
            <div class="row g-4">
                <div class="col-xl-2 col-lg-3">
                    <div class="panel admin-sidebar overflow-hidden">
                        <div class="panel-header">Điều hướng</div>
                        <div class="list-group list-group-flush">
                            <Link class="list-group-item list-group-item-action" :class="{ active: currentPath() === '/admin' }" href="/admin">Tổng quan</Link>
                            <Link class="list-group-item list-group-item-action" :class="{ active: isActive('/admin/categories') }" href="/admin/categories">Danh mục</Link>
                            <Link class="list-group-item list-group-item-action" :class="{ active: isActive('/admin/posts') }" href="/admin/posts">Bài viết</Link>
                            <Link class="list-group-item list-group-item-action d-flex justify-content-between" :class="{ active: isActive('/admin/contacts') }" href="/admin/contacts">Liên hệ <span class="badge text-bg-danger">{{ page.props.unreadContactsCount || 0 }}</span></Link>
                            <Link class="list-group-item list-group-item-action" :class="{ active: isActive('/admin/settings') }" href="/admin/settings">Cài đặt</Link>
                            <Link class="list-group-item list-group-item-action" :class="{ active: isActive('/admin/profile') }" href="/admin/profile">Hồ sơ giới thiệu</Link>
                            <Link class="list-group-item list-group-item-action" :class="{ active: isActive('/admin/visits') }" href="/admin/visits">Lượt truy cập</Link>
                            <Link class="list-group-item list-group-item-action" :class="{ active: isActive('/admin/security') }" href="/admin/security/password">Bảo mật</Link>
                        </div>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-9">
                    <slot />
                </div>
            </div>
        </main>
    </div>
</template>
