<script setup lang="ts">
	import AppLayout from "@/layouts/AppLayout.vue";
	import { Head, Link } from "@inertiajs/vue3";
	import {
		Card,
		CardContent,
		CardDescription,
		CardFooter,
		CardHeader,
		CardTitle,
	} from "@/components/ui/card";
	import { Button } from "@/components/ui/button";
	import { Play } from "lucide-vue-next";
	import AppPagination from "@/components/AppPagination.vue";
	import AppEmptyState from "@/components/AppEmptyState.vue";
	import type { PaginatedResponse, Lesson } from "@/types";

	defineProps<{
		lessons: PaginatedResponse<Lesson>;
	}>();

	const getImageUrl = (thumbnail: string | null): string => {
		return thumbnail || "https://placehold.co/600x400?text=Crypto+School";
	};
</script>

<template>
	<Head title="Crypto Lessons" />

	<AppLayout>
		<div class="flex h-full flex-1 flex-col gap-6 p-4">
			<!-- Header -->
			<div class="flex flex-col space-y-2">
				<h1 class="text-3xl font-bold tracking-tight">Lessons</h1>
				<p class="text-muted-foreground">
					Lorem ipsum, dolor sit amet consectetur adipisicing elit.
				</p>
			</div>

			<template v-if="lessons.data && lessons.data.length">
				<!-- Lessons list -->
				<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
					<Card v-for="lesson in lessons.data" :key="lesson.id" class="overflow-hidden">
						<div class="relative aspect-video w-full overflow-hidden">
							<img
								:src="getImageUrl(lesson.thumbnail_url)"
								:alt="lesson.title"
								class="h-full w-full object-cover transition-transform hover:scale-105 duration-300"
							/>
							<div
								class="absolute bottom-2 right-2 rounded bg-black/70 px-2 py-1 text-xs text-white"
							>
								{{ lesson.formatted_duration }}
							</div>
						</div>

						<CardHeader class="pb-2">
							<CardTitle class="line-clamp-1">{{ lesson.title }}</CardTitle>
						</CardHeader>

						<CardContent class="pb-2">
							<CardDescription class="line-clamp-2">
								{{ lesson.description }}
							</CardDescription>
						</CardContent>

						<CardFooter>
							<Link :href="`/lessons/${lesson.slug}`" class="w-full">
								<Button class="w-full gap-2">
									<Play class="h-4 w-4" />
									Watch Lesson
								</Button>
							</Link>
						</CardFooter>
					</Card>
				</div>

				<!-- Pagination component -->
				<AppPagination
					:links="lessons.links"
					:current-page="lessons.current_page"
					:last-page="lessons.last_page"
				>
					Showing {{ lessons.from }} to {{ lessons.to }} of {{ lessons.total }} lessons
				</AppPagination>
			</template>

			<!-- If no lessons -->
			<template v-else>
				<AppEmptyState
					v-if="!lessons.data || lessons.data.length === 0"
					title="No lessons available"
					message="Check back later for new content"
				/>
			</template>
		</div>
	</AppLayout>
</template>
