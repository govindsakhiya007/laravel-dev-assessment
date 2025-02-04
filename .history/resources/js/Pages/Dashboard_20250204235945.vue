<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';

interface Job {
  id: number;
  title: string;
  company: string;
  experience: string;
  salary: string;
  location: string;
  description: string;
  company_logo_url: string;
  skills: { id: number; name: string }[];
}

const { jobs } = usePage().props as { jobs: Job[] };
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class="bg-gray-100 min-h-screen py-10">
      <div class="text-center py-10">
        <h1 class="text-4xl font-extrabold text-gray-800">Find your dream job</h1>
        <p class="text-lg text-gray-600 mt-3">
          Looking for jobs? Browse our latest job openings to view & apply to the best jobs today!
        </p>

        <!-- Job Search Bar -->
        <div class="flex justify-center mt-6">
          <div class="flex bg-white rounded-xl shadow-md overflow-hidden">
            <input
              type="text"
              placeholder="Job title or keyword"
              class="px-4 py-3 w-80 border-none focus:outline-none"
            />
            <input
              type="text"
              placeholder="Location"
              class="px-4 py-3 w-64 border-none focus:outline-none"
            />
            <button class="bg-blue-600 px-6 py-3 text-white font-semibold hover:bg-blue-700">
              Find Jobs
            </button>
          </div>
        </div>
      </div>

      <!-- Job Listings -->
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div v-for="job in jobs" :key="job.id" class="bg-white p-6 shadow-md rounded-xl">
            <!-- Job Logo -->
            <img
              :src="job.company_logo"
              alt="Company Logo"
              class="h-12 w-12 rounded-full mb-3"
            />
            <h2 class="text-xl font-semibold">{{ job.title }}</h2>
            <p class="text-sm text-gray-500">{{ job.company }}</p>
            <div class="flex mt-2 text-sm text-gray-600">
              <span class="mr-4">{{ job.experience }}</span>
              <span class="mr-4">{{ job.salary }}</span>
              <span>{{ job.location }}</span>
            </div>
            <p class="text-gray-700 mt-4">{{ job.description }}</p>

            <!-- Skills -->
            <div class="flex gap-2 mt-4">
              <span v-for="skill in job.skills" :key="skill.id" class="bg-gray-200 text-xs px-2 py-1 rounded-full">
                {{ skill.name }}
              </span>
            </div>

            <!-- Job Tags -->
            <div class="flex gap-2 mt-4">
              <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">
                Remote
              </span>
              <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">
                Full-Time
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
