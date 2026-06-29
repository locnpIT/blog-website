<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <nav v-if="links.length > 3" class="pagination-wrap" aria-label="Phân trang">
        <Link
            v-for="link in links"
            :key="link.label"
            :href="link.url || '#'"
            class="page-btn"
            :class="{
                'is-active': link.active,
                'is-disabled': !link.url,
            }"
            v-html="link.label"
        />
    </nav>
</template>
