<script setup lang="ts">
	import AppLayout from "@/layouts/AppLayout.vue";
	import { Head, usePage } from "@inertiajs/vue3";
	import { type BreadcrumbItem, type Lesson } from "@/types";
	import VideoPlayer from "@/components/VideoPlayer/VideoPlayer.vue";

	const page = usePage<{ lesson: Lesson }>();
	const lesson = page.props.lesson;

	const breadcrumbs: BreadcrumbItem[] = [
	    {
	        title: 'Lessons',
	        href: '/lessons',
	    },
	    {
	        title: lesson.title,
	        href: `/lessons/${lesson.slug}`,
	    },
	];
</script>

<template>
	<Head :title="lesson.title" />

	<AppLayout :breadcrumbs="breadcrumbs">
		<div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
			<div class="mb-2">
				<h1 class="text-3xl font-bold tracking-tight">{{ lesson.title }}</h1>
				<p class="text-muted-foreground mt-2">
					{{ lesson.formatted_duration }}
					{{ lesson.popup_type ? ` | ${lesson.popup_type}` : "" }}
				</p>
			</div>

			<div class="w-full">
				<VideoPlayer
					:video-url="lesson.video_url"
					:title="lesson.title"
					progress-bar-color="#10B981"
					:controls-color="'#ffffff'"
					:popup-seconds-before-end="lesson.popup_seconds_before_end"
					:popup-type="lesson.popup_type"
					:popup-data="lesson.popup_data"
				/>
			</div>

			<div class="mt-6 pb-10">
				<h2 class="text-xl font-semibold mb-2">Description</h2>
				<p class="text-muted-foreground">
					{{ lesson.description }}
				</p>
			</div>
		</div>
	</AppLayout>
</template>
