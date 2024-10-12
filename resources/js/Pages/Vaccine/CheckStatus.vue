<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";
import VaccineStatus from "@/Components/VaccineStatus.vue";

defineProps({
    vaccineRecipient: {
        type: Object
    }
});

</script>

<template>
    <Head title="Check Status" />
    <div class="min-h-screen flex justify-center items-center bg-white">
        <div class="bg-gray-50 w-5/12 p-6 rounded border border-gray-200 flex flex-col gap-6">
            <div class="text-center">
                <h2 class="font-bold text-3xl">COVID VACCINE</h2>
                <h3 class="font-bold text-2xl mt-2">Vaccination Status</h3>
            </div>
            <div>
                <table class="w-full">
                    <tbody>
                    <tr class="border-b">
                        <th class="text-left px-4 py-4 font-medium text-gray-700">Name</th>
                        <td class="px-4 py-4 text-gray-500">:</td>
                        <td class="px-4 py-4">{{ vaccineRecipient.name }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="text-left px-4 py-4 font-medium text-gray-700">NID</th>
                        <td class="px-4 py-4 text-gray-500">:</td>
                        <td class="px-4 py-4">{{ vaccineRecipient.nid }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="text-left px-4 py-4 font-medium text-gray-700">Email</th>
                        <td class="px-4 py-4 text-gray-500">:</td>
                        <td class="px-4 py-4">{{ vaccineRecipient.email }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="text-left px-4 py-4 font-medium text-gray-700">Contact No</th>
                        <td class="px-4 py-4 text-gray-500">:</td>
                        <td class="px-4 py-4">{{ vaccineRecipient.contact_no }}</td>
                    </tr>
                    <tr v-if="vaccineRecipient.gender" class="border-b">
                        <th class="text-left px-4 py-4 font-medium text-gray-700">Gender</th>
                        <td class="px-4 py-4 text-gray-500">:</td>
                        <td class="px-4 py-4">{{ vaccineRecipient.gender }}</td>
                    </tr>
                    <tr v-if="vaccineRecipient.vaccine_center || vaccineRecipient.vaccine" class="border-b">
                        <th class="text-left px-4 py-4 font-medium text-gray-700">Vaccine Center</th>
                        <td class="px-4 py-4 text-gray-500">:</td>
                        <td class="px-4 py-4">
                <span v-if="!vaccineRecipient.vaccine">
                    {{ vaccineRecipient.vaccine_center.name }}
                    <p class="text-gray-500 text-sm">{{ vaccineRecipient.vaccine_center.address }}</p>
                </span>
                            <span v-else>
                    {{ vaccineRecipient.vaccine.vaccine_center.name }}
                    <p class="text-gray-500 text-sm">{{ vaccineRecipient.vaccine.vaccine_center.address }}</p>
                </span>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <th class="text-left px-4 py-4 font-medium text-gray-700">Status</th>
                        <td class="px-4 py-4 text-gray-500">:</td>
                        <td class="px-4 py-4">
                            <VaccineStatus :vaccine="vaccineRecipient.vaccine" />
                        </td>
                    </tr>
                    <tr v-if="vaccineRecipient.vaccine" class="border-b">
                        <th class="text-left px-4 py-4 font-medium text-gray-700">Vaccination Date</th>
                        <td class="px-4 py-4 text-gray-500">:</td>
                        <td class="px-4 py-4">{{ vaccineRecipient.vaccine.vaccination_date }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</template>
