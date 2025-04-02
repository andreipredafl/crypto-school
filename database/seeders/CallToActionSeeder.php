<?php

namespace Database\Seeders;

use App\Models\CallToAction;
use Illuminate\Database\Seeder;

class CallToActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CallToAction::truncate();
        
        $ctaData = [
            [
                'title' => 'Join Our Community',
                'description' => 'Connect with other crypto enthusiasts and get exclusive insights.',
                'button_text' => 'Join Discord',
                'button_url' => 'https://discord.gg/crypto-community',
                'button_color' => '#5865F2',
            ],
            [
                'title' => 'Unlock Advanced Lessons',
                'description' => 'Get access to our premium content with advanced trading strategies.',
                'button_text' => 'Upgrade Now',
                'button_url' => '/pricing',
                'button_color' => '#F7931A',
            ],
            [
                'title' => 'Subscribe to Our Newsletter',
                'description' => 'Get the latest crypto news and analysis directly to your inbox.',
                'button_text' => 'Subscribe',
                'button_url' => '/newsletter',
                'button_color' => '#3B82F6',
            ],
            [
                'title' => 'Download Our Crypto Guide',
                'description' => 'A comprehensive PDF guide to getting started with cryptocurrency.',
                'button_text' => 'Download Free Guide',
                'button_url' => '/downloads/crypto-guide',
                'button_color' => '#10B981',
            ],
            [
                'title' => 'Try Our Trading Simulator',
                'description' => 'Practice trading strategies without risking real money.',
                'button_text' => 'Start Simulator',
                'button_url' => '/simulator',
                'button_color' => '#6366F1',
            ],
        ];

        CallToAction::insert($ctaData);
    }
}