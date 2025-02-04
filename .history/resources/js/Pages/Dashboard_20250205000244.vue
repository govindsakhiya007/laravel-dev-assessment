<script setup lang="ts">
import Hero from '@/Components/Dashboard/Hero.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

interface Job {
	id: number;
	title: string;
	company_name: string;
	experience: string;
	salary: string;
	location: string;
	description: string;
	extra_info: string;
}

const jobs = ref<Job[]>([]);

async function fetchJobs() {
	try {
		const response = await axios.get('/jobs');
		jobs.value = response.data.jobs;
	} catch (error) {
		console.error('Error fetching jobs:', error);
	}
}

onMounted(() => {fetchJobs();
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <!-- Hero Section -->
    <Hero />

    <!-- Job List -->
	<div class="bg-white">
		<div class="container py-5">
			<div v-if="jobs.length === 0" class="text-center text-gray-500">
				<p>No job postings available at the moment.</p>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
				<div v-for="job in jobs" :key="job.id" class="bg-white p-6 shadow-md rounded-xl">
					<div>
						<img :src="job.company_logo_url" alt="Company Logo" class="h-12 w-12 rounded-full mb-3" />
					
						<h2 class="text-xl font-semibold">{{ job.title }}</h2>
						<p class="text-sm text-gray-500">{{ job.company_name }}</p>
					</div>

					<div class="flex mt-2 text-sm text-gray-600">
						<span class="mr-4">{{ job.experience }}</span>
						<span class="mr-4">{{ job.salary }}</span>
						<span>{{ job.location }}</span>
					</div>

					<p class="text-gray-700 mt-4">{{ job.description }}</p>

					<!-- Extra Info Tags -->
					<div class="flex gap-2 mt-4">
						<span v-for="info in job.extra_info?.split(',')" :key="info" class="bg-gray-200 text-xs px-2 py-1 rounded-full">
						{{ info }}
						</span>
					</div>

					<!-- Skills -->
					<div class="flex gap-2 mt-4">
						<span v-for="skill in job.jobSkills" class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full">
						{{ skill }}
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
  </AuthenticatedLayout>
</template>
