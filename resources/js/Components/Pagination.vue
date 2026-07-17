<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: {
        type: Array,
        default: () => [],
    },
});

const paginationLabel = (label) => {
    if (label === 'pagination.previous' || label.includes('Previous') || label.includes('&laquo;')) {
        return 'Trước';
    }

    if (label === 'pagination.next' || label.includes('Next') || label.includes('&raquo;')) {
        return 'Sau';
    }

    return label;
};
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
        >
            {{ paginationLabel(link.label) }}
        </Link>
    </nav>
</template>
