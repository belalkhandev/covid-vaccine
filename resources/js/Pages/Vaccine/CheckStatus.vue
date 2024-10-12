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
        <div class="bg-gray-50 w-6/12 p-6 rounded border border-gray-200 flex flex-col gap-6">
            <div class="text-center">
                <h2 class="font-bold text-3xl">COVID VACCINE</h2>
                <h3 class="font-bold text-2xl mt-2">Vaccination Status</h3>
            </div>

            <div>
                <table class="w-full">
                    <tbody>
                        <tr>
                            <th class="text-left">Name</th>
                            <td>:</td>
                            <td>{{ vaccineRecipient.name }}</td>
                        </tr>
                        <tr>
                            <th class="text-left">NID</th>
                            <td>:</td>
                            <td>{{ vaccineRecipient.nid }}</td>
                        </tr>
                        <tr>
                            <th class="text-left">Contact No</th>
                            <td>:</td>
                            <td>{{ vaccineRecipient.contact_no }}</td>
                        </tr>
                        <tr v-if="vaccineRecipient.gender">
                            <th class="text-left">Gender</th>
                            <td>:</td>
                            <td>{{ vaccineRecipient.gender }}</td>
                        </tr>
                        <tr v-if="vaccineRecipient.gender">
                            <th class="text-left">Vaccine Center</th>
                            <td>:</td>
                            <td>
                                <span v-if="!vaccineRecipient.vaccine">
                                    {{ vaccineRecipient.vaccine_center.name }}
                                    <p class="text-gray-500">{{ vaccineRecipient.vaccine_center.address }}</p>
                                </span>
                                <span v-else>
                                    {{ vaccineRecipient.vaccine.vaccine_center.name }}
                                    <p class="text-gray-500">{{ vaccineRecipient.vaccine.vaccine_center.address }}</p>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-left">Status</th>
                            <td>:</td>
                            <td>
                                <VaccineStatus :vaccine="vaccineRecipient.vaccine" />
                            </td>
                        </tr>
                        <tr v-if="vaccineRecipient.vaccine">
                            <th class="text-left">Vaccination Date</th>
                            <td>:</td>
                            <td>
                                {{ vaccineRecipient.vaccine.vaccination_date}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</template>
