<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";

const errorMessage = ref('');

const form = useForm({
    nid: ''
})

const submitForm = () => {
    form.post(route('vaccine.check-status'), {
        preserveScroll: true,
        onError: (error) => {
            errorMessage.value = error.message
        }
    })
}

</script>

<template>
    <Head title="Welcome" />
    <div class="min-h-screen flex justify-center items-center bg-white">
        <div class="bg-gray-50 w-96 p-6 rounded border border-gray-200 flex flex-col gap-6">
            <div>
                <h2 class="font-bold text-3xl text-center">COVID VACCINE</h2>
            </div>

            <div v-if="errorMessage" class="bg-red-100 text-red-800 p-4 rounded">
                {{ errorMessage }}
            </div>

            <div class="border-b pb-6">
                <form @submit.prevent="submitForm" class="flex flex-col gap-3">
                    <div class="form-group flex flex-col gap-1">
                        <label for="">Check Vaccine Status</label>
                        <input type="text" class="rounded border-gray-300" v-model="form.nid" placeholder="Enter your NID">
                        <InputError :message="form.errors.nid" />
                    </div>
                    <button type="submit" class="w-full bg-sky-600 text-white py-2 px-4 rounded hover:bg-sky-800 transition duration-300">Check Status</button>
                </form>
            </div>
            <div>
                <p class="text-center mb-2">Haven't Registered for the Vaccine?</p>
                <Link :href="route('register')" class="block text-center bg-gray-800 text-white py-2 px-4 rounded cursor-pointer hover:bg-sky-600 transition duration-300">Register Now</Link>
            </div>
        </div>
    </div>
</template>
