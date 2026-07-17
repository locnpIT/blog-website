<script setup>
import { onMounted, onUnmounted, ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '../../Layouts/PublicLayout.vue';
import Pagination from '../../Components/Pagination.vue';
import PostList from '../../Components/PostList.vue';
import SidebarCards from '../../Components/SidebarCards.vue';

defineProps({
    posts: Object,
    featuredPosts: Array,
    categories: Array,
    profile: Object,
    seo: Object,
});

const newsletterBanner = ref(null);
const newsletterCanvas = ref(null);

const particleConfig = {
    minParticles: 36,
    maxParticles: 58,
    particleRadiusMin: 1,
    particleRadiusMax: 2.2,
    baseSpeedMin: 0.26,
    baseSpeedMax: 0.8,
    connectionDistance: 145,
    connectionOpacity: 0.32,
    mouseRadius: 165,
    mouseForce: 0.024,
    driftForce: 0.013,
    friction: 0.986,
    maxSpeed: 1.55,
};

const pointer = {
    x: null,
    y: null,
    active: false,
};

const particles = [];

let ctx = null;
let animationFrameId = 0;
let resizeObserver = null;
let reducedMotionQuery = null;
let reducedMotionChangeHandler = null;
let reducedMotion = false;
let width = 0;
let height = 0;
let pixelRatio = 1;

const randomBetween = (min, max) => Math.random() * (max - min) + min;

const clamp = (value, min, max) => Math.min(max, Math.max(min, value));

class Particle {
    constructor() {
        this.reset();
    }

    reset() {
        this.x = Math.random() * width;
        this.y = Math.random() * height;

        const angle = Math.random() * Math.PI * 2;
        const speed = randomBetween(particleConfig.baseSpeedMin, particleConfig.baseSpeedMax);

        this.vx = Math.cos(angle) * speed;
        this.vy = Math.sin(angle) * speed;
        this.radius = randomBetween(particleConfig.particleRadiusMin, particleConfig.particleRadiusMax);
        this.alpha = randomBetween(0.55, 0.95);
        this.phase = Math.random() * Math.PI * 2;
    }

    applyRandomDrift() {
        this.vx += (Math.random() - 0.5) * particleConfig.driftForce;
        this.vy += (Math.random() - 0.5) * particleConfig.driftForce;

        this.phase += 0.012;
        this.vx += Math.cos(this.phase) * 0.0038;
        this.vy += Math.sin(this.phase * 1.27) * 0.0038;
    }

    applyPointerForce() {
        if (!pointer.active || pointer.x === null || pointer.y === null) {
            return;
        }

        const dx = pointer.x - this.x;
        const dy = pointer.y - this.y;
        const distanceSquared = dx * dx + dy * dy;
        const radiusSquared = particleConfig.mouseRadius * particleConfig.mouseRadius;

        if (distanceSquared <= 0 || distanceSquared >= radiusSquared) {
            return;
        }

        const distance = Math.sqrt(distanceSquared);
        const influence = 1 - distance / particleConfig.mouseRadius;

        this.vx += (dx / distance) * influence * particleConfig.mouseForce;
        this.vy += (dy / distance) * influence * particleConfig.mouseForce;
    }

    limitSpeed() {
        const speedSquared = this.vx * this.vx + this.vy * this.vy;
        const maxSpeedSquared = particleConfig.maxSpeed * particleConfig.maxSpeed;

        if (speedSquared <= maxSpeedSquared) {
            return;
        }

        const speed = Math.sqrt(speedSquared);
        this.vx = (this.vx / speed) * particleConfig.maxSpeed;
        this.vy = (this.vy / speed) * particleConfig.maxSpeed;
    }

    move() {
        this.x += this.vx;
        this.y += this.vy;
    }

    applyFriction() {
        this.vx *= particleConfig.friction;
        this.vy *= particleConfig.friction;
    }

    wrapAround() {
        if (this.x < -this.radius) {
            this.x = width + this.radius;
        } else if (this.x > width + this.radius) {
            this.x = -this.radius;
        }

        if (this.y < -this.radius) {
            this.y = height + this.radius;
        } else if (this.y > height + this.radius) {
            this.y = -this.radius;
        }
    }

    update() {
        this.applyRandomDrift();
        this.applyPointerForce();
        this.limitSpeed();
        this.move();
        this.applyFriction();
        this.wrapAround();
    }

    draw() {
        if (!ctx) {
            return;
        }

        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(255, 255, 255, ${this.alpha})`;
        ctx.fill();
    }
}

const createParticles = () => {
    particles.length = 0;

    const count = Math.round(
        clamp((width + height) / 34, particleConfig.minParticles, particleConfig.maxParticles),
    );

    for (let index = 0; index < count; index += 1) {
        particles.push(new Particle());
    }
};

const resizeCanvas = () => {
    const bannerEl = newsletterBanner.value;
    const canvasEl = newsletterCanvas.value;

    if (!bannerEl || !canvasEl) {
        return;
    }

    const rect = bannerEl.getBoundingClientRect();

    if (!rect.width || !rect.height) {
        return;
    }

    width = Math.max(1, Math.round(rect.width));
    height = Math.max(1, Math.round(rect.height));
    pixelRatio = Math.min(window.devicePixelRatio || 1, 2);

    canvasEl.width = Math.floor(width * pixelRatio);
    canvasEl.height = Math.floor(height * pixelRatio);
    canvasEl.style.width = `${width}px`;
    canvasEl.style.height = `${height}px`;

    ctx.setTransform(pixelRatio, 0, 0, pixelRatio, 0, 0);
    createParticles();
};

const drawPointerGlow = () => {
    if (!ctx || !pointer.active || pointer.x === null || pointer.y === null) {
        return;
    }

    const gradient = ctx.createRadialGradient(
        pointer.x,
        pointer.y,
        0,
        pointer.x,
        pointer.y,
        particleConfig.mouseRadius,
    );

    gradient.addColorStop(0, 'rgba(255, 255, 255, 0.09)');
    gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');

    ctx.beginPath();
    ctx.arc(pointer.x, pointer.y, particleConfig.mouseRadius, 0, Math.PI * 2);
    ctx.fillStyle = gradient;
    ctx.fill();
};

const connectParticles = () => {
    if (!ctx) {
        return;
    }

    const maxDistance = particleConfig.connectionDistance;
    const maxDistanceSquared = maxDistance * maxDistance;

    for (let firstIndex = 0; firstIndex < particles.length; firstIndex += 1) {
        const firstParticle = particles[firstIndex];

        for (let secondIndex = firstIndex + 1; secondIndex < particles.length; secondIndex += 1) {
            const secondParticle = particles[secondIndex];
            const dx = firstParticle.x - secondParticle.x;
            const dy = firstParticle.y - secondParticle.y;
            const distanceSquared = dx * dx + dy * dy;

            if (distanceSquared >= maxDistanceSquared) {
                continue;
            }

            const distance = Math.sqrt(distanceSquared);
            const opacity = (1 - distance / maxDistance) * particleConfig.connectionOpacity;

            ctx.beginPath();
            ctx.moveTo(firstParticle.x, firstParticle.y);
            ctx.lineTo(secondParticle.x, secondParticle.y);
            ctx.strokeStyle = `rgba(148, 163, 184, ${opacity})`;
            ctx.lineWidth = 0.8;
            ctx.stroke();
        }
    }
};

const connectPointerToParticles = () => {
    if (!ctx || !pointer.active || pointer.x === null || pointer.y === null) {
        return;
    }

    const maxDistance = particleConfig.mouseRadius;
    const maxDistanceSquared = maxDistance * maxDistance;

    for (const particle of particles) {
        const dx = pointer.x - particle.x;
        const dy = pointer.y - particle.y;
        const distanceSquared = dx * dx + dy * dy;

        if (distanceSquared >= maxDistanceSquared) {
            continue;
        }

        const distance = Math.sqrt(distanceSquared);
        const opacity = (1 - distance / maxDistance) * 0.48;

        ctx.beginPath();
        ctx.moveTo(pointer.x, pointer.y);
        ctx.lineTo(particle.x, particle.y);
        ctx.strokeStyle = `rgba(255, 255, 255, ${opacity})`;
        ctx.lineWidth = 0.9;
        ctx.stroke();
    }
};

const renderFrame = () => {
    if (!ctx) {
        return;
    }

    ctx.clearRect(0, 0, width, height);
    drawPointerGlow();

    for (const particle of particles) {
        particle.update();
    }

    connectParticles();
    connectPointerToParticles();

    for (const particle of particles) {
        particle.draw();
    }
};

const tick = () => {
    renderFrame();

    if (reducedMotion) {
        animationFrameId = 0;
        return;
    }

    animationFrameId = window.requestAnimationFrame(tick);
};

const handlePointerMove = (event) => {
    if (reducedMotion) {
        return;
    }

    const bannerEl = newsletterBanner.value;

    if (!bannerEl) {
        return;
    }

    const rect = bannerEl.getBoundingClientRect();
    pointer.x = event.clientX - rect.left;
    pointer.y = event.clientY - rect.top;
    pointer.active = true;
};

const handlePointerLeave = () => {
    pointer.x = null;
    pointer.y = null;
    pointer.active = false;
};

onMounted(() => {
    const bannerEl = newsletterBanner.value;
    const canvasEl = newsletterCanvas.value;

    if (!bannerEl || !canvasEl) {
        return;
    }

    ctx = canvasEl.getContext('2d');

    if (!ctx) {
        return;
    }

    reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
    reducedMotion = reducedMotionQuery.matches;

    reducedMotionChangeHandler = (event) => {
        reducedMotion = event.matches;
        handlePointerLeave();
        resizeCanvas();

        if (animationFrameId) {
            window.cancelAnimationFrame(animationFrameId);
            animationFrameId = 0;
        }

        if (reducedMotion) {
            renderFrame();
        } else {
            tick();
        }
    };

    resizeCanvas();
    renderFrame();

    bannerEl.addEventListener('pointermove', handlePointerMove);
    bannerEl.addEventListener('pointerenter', handlePointerMove);
    bannerEl.addEventListener('pointerleave', handlePointerLeave);

    if (typeof ResizeObserver !== 'undefined') {
        resizeObserver = new ResizeObserver(() => {
            resizeCanvas();
            renderFrame();
        });
        resizeObserver.observe(bannerEl);
    } else {
        window.addEventListener('resize', resizeCanvas);
    }

    if (reducedMotionQuery.addEventListener) {
        reducedMotionQuery.addEventListener('change', reducedMotionChangeHandler);
    } else {
        reducedMotionQuery.addListener(reducedMotionChangeHandler);
    }

    if (!reducedMotion) {
        tick();
    }
});

onUnmounted(() => {
    const bannerEl = newsletterBanner.value;

    if (animationFrameId) {
        window.cancelAnimationFrame(animationFrameId);
        animationFrameId = 0;
    }

    if (resizeObserver) {
        resizeObserver.disconnect();
        resizeObserver = null;
    } else {
        window.removeEventListener('resize', resizeCanvas);
    }

    if (reducedMotionQuery) {
        if (reducedMotionQuery.removeEventListener) {
            reducedMotionQuery.removeEventListener('change', reducedMotionChangeHandler);
        } else if (reducedMotionQuery.removeListener) {
            reducedMotionQuery.removeListener(reducedMotionChangeHandler);
        }
    }

    if (!bannerEl) {
        return;
    }

    bannerEl.removeEventListener('pointermove', handlePointerMove);
    bannerEl.removeEventListener('pointerenter', handlePointerMove);
    bannerEl.removeEventListener('pointerleave', handlePointerLeave);
});
</script>

<template>
    <Head :title="seo.title" />
    <PublicLayout>
        <!-- Featured Posts -->
        <section v-if="featuredPosts?.length" class="featured-section">
            <h2 class="section-title">Bài viết nổi bật</h2>
            <div class="featured-grid">
                <Link
                    v-for="(post, index) in featuredPosts.slice(0, 3)"
                    :key="post.id"
                    :href="`/posts/${post.slug}`"
                    class="featured-card"
                >
                    <div class="featured-card-image">
                        <img v-if="post.thumbnail_url" :src="post.thumbnail_url" :alt="post.title">
                        <div v-else class="featured-card-fallback">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    </div>
                    <div class="featured-card-body">
                        <span class="featured-card-cat">{{ post.category?.name || 'Bài viết' }}</span>
                        <p class="featured-card-title">{{ post.title }}</p>
                        <p v-if="post.excerpt" class="featured-card-excerpt">{{ post.excerpt }}</p>
                        <span class="featured-card-date">{{ post.published_date || post.created_date }}</span>
                    </div>
                </Link>
            </div>
        </section>

        <!-- Posts + Sidebar -->
        <div class="home-content">
            <div class="home-main">
                <h2 class="section-title">Bài viết mới nhất</h2>
                <PostList :posts="posts.data" />
                <Pagination :links="posts.links" />
            </div>
            <aside class="home-sidebar">
                <SidebarCards :profile="profile" :categories="categories" />
            </aside>
        </div>

        <!-- CTA Banner -->
        <section class="newsletter-banner" ref="newsletterBanner">
            <div class="newsletter-network" aria-hidden="true">
                <canvas ref="newsletterCanvas" class="newsletter-particle-canvas"></canvas>
            </div>
            <h2>Muốn trao đổi về kỹ thuật?</h2>
            <p>Gửi cho tôi một tin nhắn — về dự án, về code, hay bất cứ điều gì bạn đang xây dựng.</p>
            <Link class="newsletter-btn" href="/contact">Nhắn tin cho tôi →</Link>
        </section>

    </PublicLayout>
</template>
