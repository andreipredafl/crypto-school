# Crypto School Challenge 🚀🚀

A simple Laravel 12 + Vue 3 (Inertia + TypeScript + Tailwind) application for managing and displaying video lessons.

## Requirements

- PHP 8.3+
- Composer
- Node.js & npm
- MySQL
- Laravel valet (optional, for local `.test` domains)

## Installation

1. Clone the repository:  
   `git clone git@github.com:andreipredafl/crypto-school.git`  
   `cd crypto-school`

2. Install php dependencies:  
   `composer install`

3. Install javascript dependencies:  
   `npm install`

4. Copy the environment file and set up your environment:  
   `cp .env.example .env`

5. Generate the application key: ss
   `php artisan key:generate`

6. Set up your database:

    - Create a local database
    - Update `.env` with your database credentials

7. Run migrations:
   `php artisan migrate`
8. Run seeders:
   `php artisan db:seed`

9. Start the development servers:  
   `npm run dev`
   `php artisan serve`
10. Go to the `/login` page:

    - The test user is: `test@example.com`
    - Password: password

## Optional: run with laravel valet

`valet link`  
`valet secure`

Then access the project at: https://crypto-school.test

## Storybook for VideoPlayer

This project uses **Storybook** to develop and test the video player component in isolation.

- To start Storybook, use `npm run storybook`, then open [http://localhost:6006/](http://localhost:6006/) in your browser
- To build Storybook for production, use `npm run build-storybook`
- Story for the VideoPlayer is located in:  
  `/resources/js/components/video-player/VideoPlayer.stories.ts`

---

## Conversion optimization & A/B testing task

A/B test to improve the conversion rate of users upgrading after watching video lessons.

- **Version A (Control)**: Default blue "Upgrade now" button
- **Version B (Variant)**: Eye-catching orange/yellow **“BECOME EXPERT NOW ⏳”** button with a countdown timer and stronger messaging

The goal is to increase click-through rates and premium conversions with minimal UI changes

More details can be found in `a_b_test_plan.md` located in `/docs` (a prototype image is also included) 🚀🚀

---

## Final Thoughts 🚀

I hope what I’ve built here makes sense and shows the direction I was going for. There are still quite a few features that could be added or improved: like more advanced quiz logic, support for multiple videos per lesson, and actually wiring up the A/B testing into full analytics tracking but that would probably go beyond the scope of this challenge

Thanks for checking it out!

📈 **Time to check some charts, see the market status and pretend I know what the market’s doing** 🤣🚀
