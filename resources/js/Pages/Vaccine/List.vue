<script setup>
import {Head, Link, useForm} from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import VaccineStatus from "@/Components/VaccineStatus.vue";

const props = defineProps({
    vaccineRecipients: {
        type: Object,
        default: () => null
    },
    vaccineStatuses: {
        type: Object,
        default: () => null
    },
    vaccineCenters: {
        type: Object,
        default: () => null
    },
    filterOptions: {
        type: Object,
        default: () => null
    }
})

const form = useForm({
    'nid': props.filterOptions?.nid || '',
    'status': props.filterOptions?.status || '',
    'vaccine_center': props.filterOptions?.vaccine_center || '',
    'vaccine_date': props.filterOptions?.vaccine_date || '',
});

const submitSearch = () => {
    form.get(route('vaccine.list'), {
        preserveScroll: true
    })
}

</script>

<template>
    <Head title="Vaccine list" />
    <div class="min-h-screen bg-gray-50 w-full flex items-start justify-center">
        <div class="bg-white lg:w-10/12 md:w-full sm:w-full flex flex-col gap-4 p-4">
            <div class="text-center mb-8">
                <h2 class="font-bold text-3xl">COVID VACCINE</h2>
            </div>
            <form @submit.prevent="submitSearch" class="flex flex-wrap items-center space-x-4 mb-4">
                <div class="flex flex-col">Filter By:</div>
                <div class="flex flex-col">
                    <input
                        type="text"
                        placeholder="Search By NID"
                        v-model="form.nid"
                        class="rounded border border-gray-300 px-4 py-2 focus:outline-none focus:outline-0"
                    />
                </div>
                <div class="flex flex-col">
                    <input
                        type="date"
                        placeholder="Search Date"
                        class="rounded border border-gray-300 px-4 py-2 focus:outline-none focus:outline-0"
                        v-model="form.vaccine_date"
                    />
                </div>
                <div class="flex flex-col">
                    <select
                        v-model="form.status"
                        class="rounded border border-gray-300 px-4 py-2 focus:outline-none focus:outline-0"
                    >
                        <option value="">Any Status</option>
                        <option v-for="status in vaccineStatuses" :value="status">{{ status }}</option>
                    </select>
                </div>
                <div class="flex flex-col">
                    <select
                        v-model="form.vaccine_center"
                        class="rounded border border-gray-300 px-4 py-2 focus:outline-none focus:outline-0"
                    >
                        <option value="">All</option>
                        <option v-for="vaccine_center in vaccineCenters" :value="vaccine_center.id">{{ vaccine_center.name }}</option>
                    </select>
                </div>
                <div class="flex space-x-2">
                    <button
                        type="submit"
                        class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors"
                    >
                        Search
                    </button>
                    <Link
                        :href="route('vaccine.list')"
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition-colors"
                    >
                        Reset
                    </Link>
                </div>
            </form>
            <div>
                <table class="w-full table-auto border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">#</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">NID</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Contact No</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Vaccine Center</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Vaccine Dosage</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Reg. Date</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Vaccination Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(recipient, i) in vaccineRecipients.data" :key="i" class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">{{ i + 1 }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ recipient.name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ recipient.nid }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ recipient.contact_no }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ recipient.vaccine?.vaccine_center.name || recipient.vaccine_center.name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ recipient.vaccine?.vaccine_dosage.name || 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <VaccineStatus :vaccine="recipient.vaccine"/>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ recipient.formatted_created_at }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ recipient.formatted_created_at }}
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <div class="pagination">
                <Pagination :data="vaccineRecipients"/>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
