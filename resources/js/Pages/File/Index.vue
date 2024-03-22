<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, usePage} from '@inertiajs/vue3';
import NavLink from "@/Components/NavLink.vue";
const page = usePage()
defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    files: {
    }
});
console.log(page.props.files)
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink :href="route('user.file.index')" :active="route().current('user.file.index')">
                    Files
                </NavLink>
                <NavLink :href="route('user.file.add')" :active="route().current('user.file.add')">
                    Add new
                </NavLink>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Your files!</div>
                </div>
            </div>
        </div>
        <div v-if="page.props.files">
            <div class="py-3" v-for="file in page.props.files" :key="file.id">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg d-flex ">
                        <div class="p-6 text-gray-900">{{ file.original_name }}</div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
