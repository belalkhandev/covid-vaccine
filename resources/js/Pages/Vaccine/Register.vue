<script setup>
import {Head, Link} from "@inertiajs/vue3";

defineProps({
    vaccineCenters: {
        type: Array,
        default: () => []
    }
})

</script>

<template>
    <Head title="Welcome" />
    <div class="min-h-screen flex justify-center items-center bg-white">
        <div class="bg-gray-50 w-5/12 p-6 rounded border border-gray-200 flex flex-col gap-6">
            <div class="text-center">
                <h2 class="font-bold text-3xl">COVID VACCINE</h2>
                <h3 class="font-bold text-2xl mt-4">Registration</h3>
            </div>
            <div class="border-b pb-6">
                <form action="" class="flex flex-col gap-3">
                    <div class="form-group flex flex-col gap-1">
                        <label for="">Name</label>
                        <input type="text" class="rounded border-gray-300" placeholder="Enter Name">
                    </div>
                    <div class="form-group flex flex-col gap-1">
                        <label for="">NID</label>
                        <input type="text" class="rounded border-gray-300" placeholder="Enter NID">
                    </div>

                    <div class="form-group flex flex-col gap-1">
                        <label for="">Contact No</label>
                        <input type="text" class="rounded border-gray-300" placeholder="Enter Contact No">
                    </div>
                    <div class="form-group flex flex-col gap-1">
                        <label for="">Gender</label>
                        <select  class="rounded border-gray-300">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group flex flex-col gap-1">
                        <label for="">Vaccine Center</label>
                        <select name="" id="" class="rounded border-gray-300">
                            <option value="" disabled>Choose Vaccine Center</option>
                            <option v-for="vaccineCenter in vaccineCenters" :value="vaccineCenter.id">{{ vaccineCenter.name }}</option>
                        </select>
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
