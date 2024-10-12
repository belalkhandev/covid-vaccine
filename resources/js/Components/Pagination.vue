<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    data: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <div v-if="data.links.length > 3" class="mt-4">
        <nav class="flex justify-between items-center">
            <small v-if="data.to > 0" class="text-gray-500">
                Showing {{ data.from }} to {{ data.to }} of {{ data.total }} data.
            </small>
            <ul class="flex space-x-2">
                <li v-for="(link, k) in data.links" :key="k" class="page-item">
                    <Link
                        class="px-3 py-2 rounded border border-gray-300 text-gray-600 hover:bg-gray-100 transition-colors duration-200"
                        :class="{'bg-blue-500 text-white border-blue-500': link.active}"
                        :href="link.url ?? '#'"
                        v-html="link.label"
                    />
                </li>
            </ul>
        </nav>
    </div>
</template>
