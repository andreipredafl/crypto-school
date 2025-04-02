<?php

namespace Database\Seeders;

use App\Models\CallToAction;
use App\Models\Lesson;
use App\Models\Quiz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lesson::truncate();
        
        $lessonData = [
            [
                'title' => 'Trading Xcelerator',
                'description' => 'The Trading Xcelerator offers a fast-track system for mastering trading with simplified strategies, advanced tools, automation, and a supportive community for confident, profitable results.',
                'video_url' => 'https://www.youtube-nocookie.com/embed/iA3yoCP750c',
                'thumbnail_url' => 'https://img.youtube.com/vi/iA3yoCP750c/hqdefault.jpg',
                'duration' => 244,
                'popup_seconds_before_end' => 10,
            ],
            [
                'title' => 'Introduction to Cryptocurrency',
                'description' => 'Learn the basics of cryptocurrency, how it works, and why it matters. This beginner-friendly lesson covers the fundamental concepts of blockchain technology, digital assets, and decentralized systems.',
                'video_url' => 'https://www.youtube.com/watch?v=SSo_EIwHSd4',
                'thumbnail_url' => 'https://img.youtube.com/vi/SSo_EIwHSd4/hqdefault.jpg',
                'duration' => 359,
                'popup_seconds_before_end' => 10,
            ],
            [
                'title' => 'Understanding Blockchain Technology',
                'description' => 'Dive deep into the technology that powers cryptocurrencies. Learn how blockchain works, why it\'s secure, and how it enables trustless transactions.',
                'video_url' => 'https://www.youtube-nocookie.com/embed/iA3yoCP750c',
                'thumbnail_url' => 'https://img.youtube.com/vi/iA3yoCP750c/hqdefault.jpg',
                'duration' => 1800,
                'popup_seconds_before_end' => 15,
            ],
            [
                'title' => 'Ethereum and Smart Contracts',
                'description' => 'Explore Ethereum, the second-largest cryptocurrency platform, and learn how smart contracts are revolutionizing digital agreements and creating new possibilities.',
                'video_url' => 'https://www.youtube.com/watch?v=EH6vE97qIP4',
                'thumbnail_url' => 'https://img.youtube.com/vi/EH6vE97qIP4/hqdefault.jpg',
                'duration' => 1620,
                'popup_seconds_before_end' => 12,
            ],
            [
                'title' => 'Introduction to DeFi',
                'description' => 'Discover Decentralized Finance (DeFi) and how it\'s creating an open financial system. Learn about lending, borrowing, and earning yields without traditional intermediaries.',
                'video_url' => 'https://www.youtube.com/watch?v=H-O3r2YMWJ4',
                'duration' => 1920,
                'popup_seconds_before_end' => 15,
            ],
            [
                'title' => 'NFTs and Digital Collectibles',
                'description' => 'Understand Non-Fungible Tokens (NFTs) and how they\'re changing digital ownership, art, and collectibles. Learn how to create, buy, and sell NFTs.',
                'video_url' => 'https://www.youtube.com/watch?v=Yo9o5nDTAAQ',
                'thumbnail_url' => 'https://img.youtube.com/vi/Yo9o5nDTAAQ/hqdefault.jpg',
                'duration' => 1560,
                'popup_seconds_before_end' => 12,
            ],
            [
                'title' => 'Tokenomics and Evaluating Projects',
                'description' => 'Learn how to evaluate cryptocurrency projects by analyzing their tokenomics, team, technology, and market potential.',
                'video_url' => 'https://www.youtube.com/watch?v=ftCaqG7vis4',
                'duration' => 1740,
                'popup_seconds_before_end' => 12,
            ],
            [
                'title' => 'Security Best Practices in Crypto',
                'description' => 'Protect yourself and your investments with essential security practices. Learn about common scams, phishing attempts, and how to stay safe in the crypto space.',
                'video_url' => 'https://www.youtube.com/watch?v=4U-BQAVbCt0',
                'duration' => 1680,
                'popup_seconds_before_end' => 10,
            ],
            [
                'title' => 'The Future of Money: CBDCs and Stablecoins',
                'description' => 'Explore Central Bank Digital Currencies (CBDCs) and stablecoins, and how they are bridging traditional finance with the crypto ecosystem.',
                'video_url' => 'https://www.youtube.com/watch?v=b_ILDFp5DGA',
                'duration' => 1800,
                'popup_seconds_before_end' => 15,
            ],
            [
                'title' => 'Crypto Tax Basics',
                'description' => 'Understand the tax implications of cryptocurrency transactions. Learn about capital gains, reporting requirements, and strategies for tax efficiency.',
                'video_url' => 'https://www.youtube.com/watch?v=8eLl84iHqow',
                'duration' => 1500,
                'popup_seconds_before_end' => 10,
            ],
        ];

        $quizzes = Quiz::all();
        $ctas = CallToAction::all();

        foreach ($lessonData as $index => $data) {
            $lesson = [
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'description' => $data['description'],
                'video_url' => $data['video_url'],
                'thumbnail_url' => $data['thumbnail_url'] ?? null,
                'duration' => $data['duration'],
                'is_published' => true,
                'popup_seconds_before_end' => $data['popup_seconds_before_end'],
            ];

            if ($index < 6 && $index < $quizzes->count()) {
                $lesson['popup_type'] = Quiz::class;
                $lesson['popup_id'] = $quizzes[$index]->id;
            } 
            elseif ($index < 10 && ($index - 6) < $ctas->count()) {
                $lesson['popup_type'] = CallToAction::class;
                $lesson['popup_id'] = $ctas[$index - 6]->id;
            }

            Lesson::create($lesson);
        }
    }
}