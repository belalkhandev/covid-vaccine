<script setup>
import { computed } from 'vue';

const props = defineProps({
    vaccine: {
        type: Object,
    }
})

const vaccineStatus = computed(() => {
    if (!props.vaccine) {
        return 'Registered';
    }

    if (props.vaccine.vaccination_date) {
        const now = new Date();
        const vaccineDate = new Date(props.vaccine.vaccination_date);

        return vaccineDate < now ? 'Vaccinated' : 'Scheduled';
    } else {
        return 'Registered (Not Scheduled)';
    }
});

const statusColor = computed(() => {
    if (vaccineStatus.value === 'Vaccinated') {
        return 'text-green-600';
    } else if (vaccineStatus.value === 'Scheduled') {
        return 'text-blue-600';
    } else if (vaccineStatus.value === 'Registered (Not Scheduled)') {
        return 'text-yellow-600';
    } else {
        return 'text-gray-600';
    }
});
</script>

<template>
    <div :class="['vaccine-status', statusColor]">
        {{ vaccineStatus }}
    </div>
</template>
