<script setup lang="ts">

	import Hero from '@/Components/Dashboard/Hero.vue';
	import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
	import Icon from '@/Components/Icon.vue';
	import { Head } from '@inertiajs/vue3';
	import { ref, onMounted } from 'vue';
	import axios from 'axios';
	import dayjs from 'dayjs'
	import relativeTime from 'dayjs/plugin/relativeTime'

	dayjs.extend(relativeTime);

	interface JobSkill {
		id: number;
		name: string;
	};
	interface Job {
		id: number;
		title: string;
		company_name: string;
		experience: string;
		salary: string;
		location: string;
		description: string;
		extra_info: string;
		company_logo: string;
		job_skills: JobSkill[];
		created_at: string;
	}

	const jobs = ref<Job[]>([]);

	async function getAllJobs(filters = {}) {
		try {
			const response = await axios.get('/jobs', { params: filters });
			jobs.value = response.data.jobs;
		} catch (error) {
			console.error('Error fetching jobs:', error);
		}
	}

	onMounted(() => {
		getAllJobs();
	});
	
	function searchJobs({ title, location }: { title: string; location: string }) {
		getAllJobs({ title, location });
	}
</script>

<template>
	<Head title="Dashboard" />

	<AuthenticatedLayout>

    <!-- Hero Section -->
    <Hero @search="searchJobs" />

    <!-- Job Lists -->
	<div class="bg-white">
		<div class="container py-5">
			<div v-if="jobs.length === 0" class="text-center text-gray-500">
				<p>There are no any job postings.</p>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
				<div v-for="job in jobs" :key="job.id" class="bg-white p-6 border border-solid rounded-xl">
					<div class="flex">
						<img :src="job.company_logo" alt="Company Logo" class="h-12 w-12 rounded-full mb-3 mr-3 size-14 flex-none" />
						<div class="size-10 grow">
							<h2 class="text-xl font-semibold">{{ job.title }}</h2>
							<p class="text-sm text-gray-500">{{ job.company_name }}</p>
						</div>
						<!-- Extra Info -->
						<div>
							<span v-for="info in job.extra_info?.split(',')" :key="info" class="bg-gray-300 text-xs px-2 py-1 mr-2 rounded-xl">{{ info }}</span>
						</div>
					</div>
					<!-- Experience, salary and location -->
					<div class="flex mt-2 text-sm text-gray-600">
						<span class="flex"><Icon name="briefcase" class="w-5 h-5 text-gray-500" />{{ job.experience }} |&nbsp;</span>
						<span class="flex"><Icon name="rupee" class="w-5 h-5 text-gray-500" />{{ job.salary }} |&nbsp;</span>
						<span class="flex"><Icon name="location" class="w-5 h-5 text-gray-500" />{{ job.location }}</span>
					</div>
					<div class="flex">
						<div class="content-center"><Icon name="file" class="w-5 h-5 text-gray-500 mr-4" /></div>
						<p class="text-gray-500 mt-4">{{ job.description }}</p>
					</div>
					<!-- Skills -->
					<div class="gap-2 mt-4 text-gray-500">
						<ul class="flex">
							<li
								v-for="(skill, index) in job.job_skills"
								:key="skill.id"
								class="text-xs px-2 py-1 mr-3 relative pl-4"
								>
							<span
								v-if="index !== 0"
								class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-1 bg-black rounded-full"
								></span>
								{{ skill.name }}
							</li>
						</ul>
					</div>
					<div class="text-right text-gray-500"><span class="text-xs px-2 py-1 mr-3 relative pl-4">{{ dayjs(job.created_at).fromNow() }}</span></div>
				</div>
			</div>
		</div>
	</div>
	</AuthenticatedLayout>
</template>
