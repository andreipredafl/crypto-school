<script setup lang="ts">
	import AppLayout from "@/layouts/AppLayout.vue";
	import { Head } from "@inertiajs/vue3";
	import PlaceholderPattern from "@/components/PlaceholderPattern.vue";
</script>

<template>
	<Head title="Lessons" />

	<AppLayout>
		<div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
			<div
				class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min"
			>
				<PlaceholderPattern />
			</div>
		</div>
	</AppLayout>
</template>
