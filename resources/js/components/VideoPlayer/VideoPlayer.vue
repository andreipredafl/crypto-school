<script setup lang="ts">
	import { ref, onMounted, computed, onUnmounted } from "vue";
	import {
		Play,
		Pause,
		Volume2,
		VolumeX,
		Maximize,
		SkipForward,
		Rewind,
	} from "lucide-vue-next";
	import VideoPopup from "@/components/VideoPlayer/VideoPopup.vue";
	import type { QuizData, CtaData } from "@/types";

	export type PopupData = QuizData | CtaData;

	const delaultLogoUrl = "https://fxpro.news/wp-content/uploads/2025/01/image-28.png";
	const props = withDefaults(
		defineProps<{
			videoUrl: string;
			title?: string;
			logoUrl?: string;
			progressBarColor?: string;
			controlsColor?: string;
			popupSecondsBeforeEnd?: number;
			popupType?: "quiz" | "cta";
			popupData?: QuizData | CtaData;
		}>(),
		{
			title: "",
			logoUrl: delaultLogoUrl,
			progressBarColor: "#10B981",
			controlsColor: "#ffffff",
			popupSecondsBeforeEnd: 10,
			popupType: "cta",
			popupData: () => ({
				title: "Default CTA",
				description: "This is a default call to action",
				button: {
					text: "Click me",
					url: "#",
					bgColor: "#10B981",
					color: "#ffffff",
				},
			}),
		}
	);

	const player = ref<YT.Player | null>(null);
	const playerReady = ref(false);
	const isPlaying = ref(false);
	const isMuted = ref(false);
	const currentTime = ref(0);
	const duration = ref(0);
	const progress = ref(0);
	const showPopup = ref(false);
	const timeUpdateInterval = ref<number | null>(null);
	const popupClosed = ref(false);

	// Extract id, this is the case for YouTubee links
	// For others players, must be implemented separately
	// This implements embed, watch
	const videoId = computed(() => {
		try {
			const url = new URL(props.videoUrl);

			if (url.hostname.includes("youtube.com") && url.pathname === "/watch") {
				return url.searchParams.get("v") || "";
			} else if (
				url.hostname.includes("youtube.com") &&
				url.pathname.startsWith("/embed/")
			) {
				return url.pathname.split("/embed/")[1];
			} else if (url.hostname.includes("youtu.be")) {
				return url.pathname.substring(1);
			}

			return "";
		} catch {
			return "";
		}
	});

	onMounted(() => {
		if (!props.videoUrl) {
			console.error("Video url not found");
			return;
		}

		if (!window.YT) {
			const tag = document.createElement("script");
			tag.src = "https://www.youtube.com/iframe_api";
			document.head.appendChild(tag);
			window.onYouTubeIframeAPIReady = initPlayer;
		} else {
			initPlayer();
		}
	});

	onUnmounted(() => {
		if (timeUpdateInterval.value) {
			clearInterval(timeUpdateInterval.value);
		}
	});

	const hasPopup = computed(() => !!props.popupType && !!props.popupData);

	const initPlayer = () => {
		try {
			if (!window.YT) {
				setTimeout(initPlayer, 100);
				return;
			}

			player.value = new window.YT.Player("youtube-player", {
				videoId: videoId.value,
				playerVars: {
					controls: 0,
					disablekb: 1,
					enablejsapi: 1,
					iv_load_policy: 3,
					modestbranding: 1,
					rel: 0,
					fs: 0,
					// loop: 1,
					playlist: videoId.value,
					playsinline: 1,
					origin: window.location.origin,
					enablesapi: 1,
				},
				events: {
					onReady: onPlayerReady,
					onStateChange: onPlayerStateChange,
					onError: (e: YT.OnErrorEvent) => {
						console.error("Error:", e);
					},
				},
			});
		} catch (error) {
			console.error("Error player:", error);
		}
	};

	const onPlayerReady = () => {
		if (!player.value) return;

		playerReady.value = true;
		duration.value = player.value.getDuration() || 0;

		timeUpdateInterval.value = setInterval(() => {
			if (playerReady.value && player.value) {
				currentTime.value = player.value.getCurrentTime() || 0;
				progress.value = duration.value ? (currentTime.value / duration.value) * 100 : 0;

				console.log("current time:", currentTime.value);
				if (
					hasPopup.value &&
					duration.value - currentTime.value <= props.popupSecondsBeforeEnd &&
					!showPopup.value &&
					duration.value > 0 &&
					!popupClosed.value
				) {
					showPopup.value = true;
				}
			}
		}, 1000);
	};

	const onPlayerStateChange = (event: YT.OnStateChangeEvent) => {
		if (!window.YT) return;

		isPlaying.value = event.data === window.YT.PlayerState.PLAYING;

		if (event.data === window.YT.PlayerState.ENDED) {
			popupClosed.value = false;
		}
	};

	const togglePlay = () => {
		if (!playerReady.value || !player.value) return;

		if (isPlaying.value) {
			player.value.pauseVideo();
		} else {
			player.value.playVideo();
		}
	};

	const toggleMute = () => {
		if (!playerReady.value || !player.value) return;

		isMuted.value = !isMuted.value;

		if (isMuted.value) {
			player.value.mute();
		} else {
			player.value.unMute();
		}
	};

	const seekTo = (event: MouseEvent) => {
		if (!playerReady.value || !player.value) return;
		const rect = (event.currentTarget as HTMLElement).getBoundingClientRect();
		const pos = (event.clientX - rect.left) / rect.width;
		player.value.seekTo(duration.value * pos, true);
	};

	const skipForward = () => player.value?.seekTo(currentTime.value + 10, true);
	const rewind = () => player.value?.seekTo(currentTime.value - 10, true);

	const enterFullscreen = () => {
		document.getElementById("video-container")?.requestFullscreen();
	};

	const formatTime = (seconds: number): string => {
		const mins = Math.floor(seconds / 60);
		const secs = Math.floor(seconds % 60);
		return `${mins}:${secs < 10 ? "0" : ""}${secs}`;
	};

	const closePopup = () => {
		showPopup.value = false;
		popupClosed.value = true;
	};
</script>

<template>
	<div
		id="video-container"
		class="relative w-full aspect-video bg-black rounded-lg overflow-hidden"
	>
		<!-- Container -->
		<div id="youtube-player" class="w-full h-full"></div>

		<!-- Overlay -->
		<div class="absolute top-7 left-7 z-10">
			<img :src="logoUrl" alt="Logo image" class="h-20 w-auto" />
		</div>

		<div
			v-if="player && player.getPlayerState && player.getPlayerState() === 0"
			class="absolute inset-0 bg-black z-10 bg-green-800/40 transition-opacity duration-300"
		></div>

		<!-- Controls -->
		<div
			class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent flex flex-col gap-2 z-20"
			:style="{ color: controlsColor }"
		>
			<!-- Progress bar -->
			<div class="w-full h-2 bg-white/20 rounded cursor-pointer relative" @click="seekTo">
				<div
					class="h-full rounded absolute top-0 left-0"
					:style="{ width: `${progress}%`, backgroundColor: progressBarColor }"
				></div>
			</div>

			<!-- Controls row -->
			<div class="flex items-center justify-between">
				<div class="flex items-center gap-4">
					<button
						@click="togglePlay"
						class="focus:outline-none p-2 rounded-xl bg-green-800/20 border border-green-500/30 hover:bg-green-500/30 transition-colors"
					>
						<Play v-if="!isPlaying" class="w-6 h-6" />
						<Pause v-else class="w-6 h-6" />
					</button>

					<button
						@click="rewind"
						class="focus:outline-none p-2 rounded-xl bg-green-800/20 border border-green-500/30 hover:bg-green-500/30 transition-colors hidden sm:block"
					>
						<Rewind class="w-6 h-6" />
					</button>

					<button
						@click="skipForward"
						class="focus:outline-none p-2 rounded-xl bg-green-800/20 border border-green-500/30 hover:bg-green-500/30 transition-colors hidden sm:block"
					>
						<SkipForward class="w-6 h-6" />
					</button>

					<button
						@click="toggleMute"
						class="focus:outline-none p-2 rounded-xl bg-green-800/20 border border-green-500/30 hover:bg-green-500/30 transition-colors"
					>
						<Volume2 v-if="!isMuted" class="w-6 h-6" />
						<VolumeX v-else class="w-6 h-6" />
					</button>

					<div class="text-sm font-medium">
						{{ formatTime(currentTime) }} / {{ formatTime(duration) }}
					</div>
				</div>

				<div>
					<button
						@click="enterFullscreen"
						class="focus:outline-none p-2 rounded-xl bg-green-800/20 border border-green-500/30 hover:bg-green-500/30 transition-colors"
					>
						<Maximize class="w-6 h-6" />
					</button>
				</div>
			</div>
		</div>

		<VideoPopup
			v-if="showPopup"
			:type="popupType"
			:data="props.popupData"
			@close="closePopup"
		/>
	</div>
</template>
