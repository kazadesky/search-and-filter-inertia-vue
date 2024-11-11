<template>
    <div class="flex justify-between items-start mt-4">
        <div class="flex items-center rounded-md overflow-hidden shadow-lg">
            <div v-for="link in paginator.links" :key="link.url || link.label">
                <component :is="link.url ? 'Link' : 'span'" :href="link.url" v-html="markLabel(link.label)"
                    class="border-x border-slate-50 h-12 w-12 grid place-items-center bg-white" :class="{
                        'hover:bg-slate-300 cursor-pointer': link.url,
                        'text-zinc-400': !link.url,
                        'font-bold text-blue-500': link.active,
                    }" preserve-scroll />
            </div>
        </div>
        <p class="text-slate-600 text-sm">
            Showing {{ paginator.from }} to {{ paginator.to }} of {{ paginator.total }} results
        </p>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    paginator: {
        type: Object,
        required: true,
    },
});

const markLabel = (label) => {
    if (label && typeof label === 'string') {
        if (label.includes("Previous")) {
            return "&laquo;";
        } else if (label.includes("Next")) {
            return "&raquo;";
        }
    }
    return label;
};
</script>
