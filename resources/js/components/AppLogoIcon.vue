<script setup lang="ts">
	import type { HTMLAttributes } from "vue";

	defineOptions({
		inheritAttrs: false,
	});

	interface Props {
		className?: HTMLAttributes["class"];
	}

	defineProps<Props>();
</script>

<template>
	<img
		:class="className"
		v-bind="$attrs"
		src="https://dasq5kvfrtkjz.cloudfront.net/613d6cb6-ea50-4940-89bc-528a0f7e14a4/assets/logo_CryptoSchool-626x556.png"
		alt="Crypto School Logo"
	/>
</template>
