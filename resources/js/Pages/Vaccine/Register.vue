<script setup>
import {Head, Link, useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

defineProps({
    vaccineCenters: {
        type: Array,
        default: () => []
    }
});

const form = useForm({
    name: '',
    nid: '',
    contact_no: '',
    gender: '',
    vaccine_center_id: ''
});

const submitForm = () => {
    form.post(route('register'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        }
    })
}

</script>

<template>
    <Head title="Welcome" />
    <div class="min-h-screen flex justify-center items-center bg-white">
        <div class="bg-gray-50 w-112 p-6 rounded border border-gray-200 flex flex-col gap-6">
            <div class="text-center">
                <h2 class="font-bold text-3xl">COVID VACCINE</h2>
                <h3 class="font-bold text-2xl mt-4">Registration</h3>
            </div>
            <div class="border-b pb-6">
                <form @submit.prevent="submitForm" class="flex flex-col gap-3">
                    <div class="form-group flex flex-col gap-1">
                        <label for="">Name</label>
                        <input type="text" class="rounded border-gray-300" v-model="form.name" placeholder="Enter Name">
                        <InputError :message="form.errors.name" />
                    </div>
                    <div class="form-group flex flex-col gap-1">
                        <label for="">NID</label>
                        <input type="text" class="rounded border-gray-300" v-model="form.nid" placeholder="Enter NID">
                        <InputError :message="form.errors.nid" />
                    </div>

                    <div class="form-group flex flex-col gap-1">
                        <label for="">Contact No</label>
                        <input type="text" class="rounded border-gray-300" v-model="form.contact_no" placeholder="Enter Contact No">
                        <InputError :message="form.errors.contact_no" />
                    </div>
                    <div class="form-group flex flex-col gap-1">
                        <label for="">Gender</label>
                        <select  class="rounded border-gray-300" v-model="form.gender">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <InputError :message="form.errors.gender" />
                    </div>
                    <div class="form-group flex flex-col gap-1">
                        <label for="">Vaccine Center</label>
                        <select v-model="form.vaccine_center_id" class="rounded border-gray-300">
                            <option value="" disabled>Choose Vaccine Center</option>
                            <option v-for="vaccineCenter in vaccineCenters" :value="vaccineCenter.id">{{ vaccineCenter.name }}</option>
                        </select>
                        <InputError :message="form.errors.vaccine_center_id" />
                    </div>
                    <button type="submit" class="w-full bg-sky-600 text-white py-2 px-4 rounded hover:bg-sky-800 transition duration-300">Submit</button>
                </form>
            </div>
            <div>
                <p class="text-center mb-2">Already Registered for the Vaccine?</p>
                <Link :href="route('home')" class="block text-center bg-gray-800 text-white py-2 px-4 rounded cursor-pointer hover:bg-sky-600 transition duration-300">Check Vaccine Status</Link>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
