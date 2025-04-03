<script setup lang="ts">
	import { computed } from "vue";
	import { Button } from "@/components/ui/button";
	import { X } from "lucide-vue-next";
	import type { QuizData, CtaData } from "@/types";

	interface Props {
		type: "quiz" | "cta";
		data: QuizData | CtaData;
	}

	const props = defineProps<Props>();
	const emit = defineEmits(["close"]);

	const isQuizData = (data: any): data is QuizData => {
		return data && "question" in data && "answers" in data;
	};
	const isQuiz = computed(() => props.type === "quiz" && isQuizData(props.data));

	const closePopup = () => {
		emit("close");
	};

	const handleUrl = (url: string) => {
		if (url) {
			window.open(url, "_blank");
		}
		closePopup();
	};

	const handleAnswer = (answer: { text: string; [key: string]: any }) => {
		console.log("Selected answer:", answer);

		alert(
			"Thank you for your answer. TODO: server call to check if answer is correct 🚀🚀🚀"
		);

		closePopup();
	};
</script>

<template>
	<div class="absolute inset-0 flex items-center justify-center z-20 bg-black/50 p-4">
		<div
			class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full relative dark:bg-gray-800"
		>
			<!-- Close popup -->
			<button
				@click="closePopup"
				class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
				aria-label="Close popup"
			>
				<X class="w-5 h-5" />
			</button>

			<!-- Quiz case -->
			<div v-if="isQuiz" class="space-y-4">
				<h3 class="text-xl font-bold text-gray-900 dark:text-white">
					{{ (props.data as QuizData).question }}
				</h3>

				<div class="space-y-2">
					<div
						v-for="(answer, index) in (props.data as QuizData).answers"
						:key="index"
						class="p-3 border rounded-md cursor-pointer hover:bg-gray-100 transition-colors dark:border-gray-700 dark:hover:bg-gray-700"
						@click="handleAnswer(answer)"
					>
						{{ answer.text }}
					</div>
				</div>
			</div>

			<!-- CTA case -->
			<div v-else class="space-y-4">
				<h3 class="text-xl font-bold text-gray-900 dark:text-white">
					{{ (props.data as CtaData).title }}
				</h3>
				<p class="text-gray-600 dark:text-gray-300">
					{{ (props.data as CtaData).description }}
				</p>

				<div class="flex justify-center pt-2">
					<Button
						@click="handleUrl((props.data as CtaData).button.url)"
						:style="{
							backgroundColor: (props.data as CtaData).button.bgColor,
							color: (props.data as CtaData).button.color
						}"
						class="w-full"
					>
						{{ (props.data as CtaData).button.text }}
					</Button>
				</div>
			</div>
		</div>
	</div>
</template>
