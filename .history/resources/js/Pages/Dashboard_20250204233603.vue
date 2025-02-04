<script setup lang="ts">
import Hero from '@/Components/Dashboard/Hero.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

export default {
    props: {
        jobs: Array,
    },
    };
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- Hero -->
        <Hero />

        <!-- Job List -->
        <div class="bg-white">
            <div class="container py-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div v-for="job in jobs" :key="job.id" class="bg-white p-6 shadow-md rounded-xl">
                        <h2 class="text-xl font-semibold">{{ job.title }}</h2>
                        <p class="text-sm text-gray-500">{{ job.company }}</p>
                        <div class="flex mt-2 text-sm text-gray-600">
                            <span class="mr-4">{{ job.experience }}</span>
                            <span class="mr-4">{{ job.salary }}</span>
                            <span>{{ job.location }}</span>
                        </div>
                        <p class="text-gray-700 mt-4">{{ job.description }}</p>
                        <div class="flex gap-2 mt-4">
                            <span v-for="info in job.extra_info.split(',')" :key="info" class="bg-gray-200 text-xs px-2 py-1 rounded-full">
                                {{ info }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
