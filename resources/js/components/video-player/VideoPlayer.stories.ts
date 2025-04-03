import VideoPlayer from '@/components/video-player/VideoPlayer.vue';
import type { CtaData, QuizData } from '@/types';
import type { Meta, StoryObj } from '@storybook/vue3';

/**
 * # Video Player
 *
 * A custom YouTube video player with interactive elements for educational content.
 */
const meta: Meta<typeof VideoPlayer> = {
    title: 'Components/VideoPlayer',
    component: VideoPlayer,
    tags: ['autodocs'],
    argTypes: {
        videoUrl: { control: 'text' },
        title: { control: 'text' },
        logoUrl: { control: 'text' },
        progressBarColor: { control: 'color' },
        controlsColor: { control: 'color' },
        popupSecondsBeforeEnd: { control: 'number' },
        popupType: {
            control: 'select',
            options: ['quiz', 'cta'],
        },
        popupData: { control: 'object' },
    },
};

export default meta;
type Story = StoryObj<typeof VideoPlayer>;

/**
 * Basic setup with default styling
 */
export const Default: Story = {
    args: {
        videoUrl: 'https://www.youtube.com/embed/iA3yoCP750c',
        title: 'Trading Xcelerator',
        progressBarColor: '#10B981',
        controlsColor: '#ffffff',
        popupSecondsBeforeEnd: 10,
        popupType: 'cta',
        popupData: {
            title: 'Enjoying the lesson?',
            description: 'Check out our other courses to continue learning!',
            button: {
                text: 'Browse Courses',
                url: '#',
                bgColor: '#10B981',
                color: '#ffffff',
            },
        } as CtaData,
    },
};

/**
 * Example with custom logo
 */
export const CustomLogo: Story = {
    args: {
        videoUrl: 'https://www.youtube.com/embed/iA3yoCP750c',
        title: 'Trading Xcelerator',
        // logoUrl: 'https://fxpro.news/wp-content/uploads/2025/01/image-28.png',
        logoUrl: 'https://dasq5kvfrtkjz.cloudfront.net/613d6cb6-ea50-4940-89bc-528a0f7e14a4/assets/logo_CryptoSchool-626x556.png',
        progressBarColor: '#FF5733',
        controlsColor: '#FFFFFF',
        popupSecondsBeforeEnd: 10,
        popupType: 'cta',
        popupData: {
            title: 'Ready to master these skills?',
            description: 'Our advanced course will take your knowledge to the next level',
            button: {
                text: 'Enroll Today',
                url: '#',
                bgColor: '#FF5733',
                color: '#ffffff',
            },
        } as CtaData,
    },
};

/**
 * Example with quiz functionality
 */
export const WithQuiz: Story = {
    args: {
        videoUrl: 'https://www.youtube.com/embed/iA3yoCP750c',
        title: 'Trading Xcelerator',
        progressBarColor: '#F7DF1E',
        controlsColor: '#ffffff',
        popupSecondsBeforeEnd: 15,
        popupType: 'quiz',
        popupData: {
            question: 'Which of the following is not a JavaScript data type?',
            answers: [{ text: 'String' }, { text: 'Integer', isCorrect: true }, { text: 'Boolean' }, { text: 'Symbol' }],
        } as QuizData,
    },
};

/**
 * Example with early popup (30 seconds before end)
 */
export const EarlyPopup: Story = {
    args: {
        videoUrl: 'https://www.youtube.com/embed/iA3yoCP750c',
        title: 'Trading Xcelerator',
        progressBarColor: '#264de4',
        controlsColor: '#ffffff',
        popupSecondsBeforeEnd: 30,
        popupType: 'cta',
        popupData: {
            title: 'Want to learn more?',
            description: 'This popup appears 30 seconds before the video ends!',
            button: {
                text: 'Download Resources',
                url: '#',
                bgColor: '#264de4',
                color: '#ffffff',
            },
        } as CtaData,
    },
};
