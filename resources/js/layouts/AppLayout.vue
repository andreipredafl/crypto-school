<script setup lang="ts">
	import AppContent from "@/components/AppContent.vue";
	import AppHeader from "@/components/AppHeader.vue";
	import AppShell from "@/components/AppShell.vue";
	import AppFooter from "@/components/AppFooter.vue";
	import type { BreadcrumbItem } from "@/types";

	interface Props {
		breadcrumbs?: BreadcrumbItem[];
	}

	withDefaults(defineProps<Props>(), {
		breadcrumbs: () => [],
	});
</script>

<template>
	<AppShell class="flex-col">
		<AppHeader :breadcrumbs="breadcrumbs" />
		<AppContent>
			<slot />
		</AppContent>
		<AppFooter />
	</AppShell>
</template>
