<script setup lang="ts">
	import AppLayout from "@/layouts/AppLayout.vue";
	import { Head, usePage } from "@inertiajs/vue3";
	import PlaceholderPattern from "@/components/PlaceholderPattern.vue";
	import { type BreadcrumbItem, type Lesson } from "@/types";

	const page = usePage<{ lesson: Lesson }>();
	const lesson = page.props.lesson;

	const breadcrumbs: BreadcrumbItem[] = [
	    {
	        title: 'Lessons',
	        href: '/lessons',
		},
	    {
	        title: lesson.title,
	        href: '/lessons',
	    },
	];
</script>

<template>
	<Head title="Lesson title example" />

	<AppLayout :breadcrumbs="breadcrumbs">
		<div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
			<div
				class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min"
			>
				<PlaceholderPattern />
			</div>
		</div>
	</AppLayout>
</template>
