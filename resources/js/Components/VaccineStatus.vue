<script setup>
import { computed } from 'vue';
import {usePage} from "@inertiajs/vue3";

const { props } = usePage();
const vaccine = props.vaccine;

const vaccineStatus = computed(() => {
    if (!vaccine) {
        return 'Registered';
    }

    if (vaccine.vaccination_date) {
        const now = new Date();
        const vaccineDate = new Date(vaccine.vaccination_date);

        if (vaccineDate < now) {
            return 'Vaccinated';
        } else {
            return 'Scheduled';
        }
    } else {
        return 'Registered (Not Scheduled)';
    }
});
</script>

<template>
    <div class="vaccine-status">
        {{ vaccineStatus }}
    </div>
</template>

