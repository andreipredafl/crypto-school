import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface Lesson {
    id: number;
    title: string;
    slug: string;
    description: string;
    video_url: string;
    thumbnail_url: string | null;
    duration: number | null;
    formatted_duration: string | '00:00';
    popup_seconds_before_end?: number;
    popup_type?: 'quiz' | 'cta';
    popup_data?: PopupData;
}

export interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

export interface PaginatedResponse<T> {
    data: T[];
    current_page: number;
    last_page: number;
    links: PaginationLink[];
    from: number;
    to: number;
    total: number;
    per_page: number;
}

export interface QuizData {
    question: string;
    answers: Array<{
        text: string;
        isCorrect?: boolean;
        [key: string]: any;
    }>;
}

export interface CtaData {
    title: string;
    description: string;
    button: {
        text: string;
        url: string;
        bgColor?: string;
        color?: string;
    };
}

export type PopupData = QuizData | CtaData;

export declare global {
    interface Window {
        YT: any;
        onYouTubeIframeAPIReady: () => void;
    }
}

/*
    I also included Youtube types
    More details in file tsconfig.json at typeRoots and types
*/
