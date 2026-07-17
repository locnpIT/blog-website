<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed, nextTick, onMounted, onUnmounted, ref, watch } from 'vue';
import PublicLayout from '../../Layouts/PublicLayout.vue';
import PostList from '../../Components/PostList.vue';
import SidebarCards from '../../Components/SidebarCards.vue';

const props = defineProps({
    post: Object,
    relatedPosts: Array,
    sidebarCategories: Array,
    seo: Object,
});

const contentRef = ref(null);
const tocItems = ref([]);
const activeId = ref('');
const progress = ref(0);
let tocObserver = null;

const readTime = computed(() => {
    const text = props.post.content?.replace(/<[^>]*>/g, '') || '';
    const words = text.trim().split(/\s+/).filter(Boolean).length;
    return Math.max(1, Math.ceil(words / 200));
});

const slugify = (value) => value
    .toLowerCase()
    .trim()
    .normalize('NFD')
    .replace(/[̀-ͯ]/g, '')
    .replace(/[đĐ]/g, 'd')
    .replace(/[^a-z0-9\s-]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-')
    .replace(/^-+|-+$/g, '');

const setupTocObserver = () => {
    tocObserver?.disconnect();
    if (!contentRef.value) return;
    tocObserver = new IntersectionObserver(
        (entries) => {
            const visible = entries.filter(e => e.isIntersecting);
            if (visible.length) activeId.value = visible[0].target.id;
        },
        { rootMargin: '-80px 0px -60% 0px', threshold: 0 }
    );
    contentRef.value.querySelectorAll('h2, h3, h4').forEach(h => tocObserver.observe(h));
};

const enhanceArticle = async () => {
    await nextTick();

    if (!contentRef.value) return;

    const headings = Array.from(contentRef.value.querySelectorAll('h2, h3, h4'));
    const usedIds = new Map();

    tocItems.value = headings.map((heading, index) => {
        const baseId = slugify(heading.textContent || `section-${index + 1}`) || `section-${index + 1}`;
        const count = usedIds.get(baseId) || 0;
        usedIds.set(baseId, count + 1);

        const id = count ? `${baseId}-${count + 1}` : baseId;
        heading.id = id;

        return {
            id,
            text: heading.textContent,
            level: heading.tagName.toLowerCase(),
        };
    });

    contentRef.value.querySelectorAll('.code-copy').forEach((button) => button.remove());
    contentRef.value.querySelectorAll('pre').forEach((pre) => {
        pre.classList.add('code-block');

        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'code-copy';
        button.textContent = 'Copy';
        button.addEventListener('click', async () => {
            const code = pre.querySelector('code')?.innerText || pre.innerText || '';

            try {
                await navigator.clipboard.writeText(code);
                button.textContent = 'Copied';
                setTimeout(() => { button.textContent = 'Copy'; }, 1200);
            } catch {
                button.textContent = 'Không copy được';
                setTimeout(() => { button.textContent = 'Copy'; }, 1200);
            }
        });

        pre.appendChild(button);
    });

    setupTocObserver();
};

const updateProgress = () => {
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    progress.value = docHeight > 0 ? Math.min(100, (scrollTop / docHeight) * 100) : 0;
};

onMounted(() => {
    enhanceArticle();
    window.addEventListener('scroll', updateProgress, { passive: true });
});

onUnmounted(() => {
    window.removeEventListener('scroll', updateProgress);
    tocObserver?.disconnect();
});

watch(() => props.post.content, enhanceArticle);
</script>

<template>
    <Head :title="seo.title" />
    <div class="read-progress" :style="{ width: progress + '%' }"></div>
    <PublicLayout>
        <div class="content-layout">
            <article class="post-page">
                <nav class="post-breadcrumb" aria-label="Breadcrumb">
                    <Link href="/">Trang chủ</Link>
                    <template v-if="post.category">
                        <span>/</span>
                        <Link :href="`/categories/${post.category.slug}`">{{ post.category.name }}</Link>
                    </template>
                </nav>
                <div class="post-meta">
                    <span v-if="post.category?.name">{{ post.category.name }}</span>
                    <span v-if="post.category?.name" class="post-meta-dot"></span>
                    <span>{{ post.published_datetime }}</span>
                    <span class="post-meta-dot"></span>
                    <span>{{ readTime }} phút đọc</span>
                </div>
                <h1 class="post-page-title">{{ post.title }}</h1>
                <p v-if="post.excerpt" class="post-page-subtitle">{{ post.excerpt }}</p>
                <div v-if="post.thumbnail_url" class="post-page-image">
                    <img :src="post.thumbnail_url" :alt="post.title">
                </div>
                <div ref="contentRef" class="post-page-content" v-html="post.content"></div>
            </article>

            <aside class="home-sidebar">
                <section v-if="tocItems.length" class="sidebar-card toc-card">
                    <h3>Mục lục</h3>
                    <nav class="toc-list" aria-label="Mục lục bài viết">
                        <a
                            v-for="item in tocItems"
                            :key="item.id"
                            :href="`#${item.id}`"
                            :class="['toc-link', `toc-${item.level}`, { 'is-active': activeId === item.id }]"
                        >
                            {{ item.text }}
                        </a>
                    </nav>
                </section>
                <SidebarCards :categories="sidebarCategories" />
            </aside>
        </div>

        <section v-if="relatedPosts?.length" class="related-simple">
            <h2 class="section-title">Bài viết liên quan</h2>
            <PostList :posts="relatedPosts" layout="list" />
        </section>
    </PublicLayout>
</template>
