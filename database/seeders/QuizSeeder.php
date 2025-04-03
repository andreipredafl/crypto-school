<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lesson::truncate();
        
        $quizData = [
            [
                'question' => 'What is the maximum supply of Bitcoin?',
                'answers' => [
                    ['text' => '21 million', 'is_correct' => true],
                    ['text' => '42 million', 'is_correct' => false],
                    ['text' => 'Unlimited', 'is_correct' => false],
                    ['text' => '100 million', 'is_correct' => false],
                ]
            ],
            [
                'question' => 'Which consensus mechanism is Ethereum using?',
                'answers' => [
                    ['text' => 'Proof of Stake', 'is_correct' => true],
                    ['text' => 'Proof of Work', 'is_correct' => false],
                    ['text' => 'Proof of Authority', 'is_correct' => false],
                    ['text' => 'Proof of History', 'is_correct' => false],
                ]
            ],
            [
                'question' => 'What is a smart contract?',
                'answers' => [
                    ['text' => 'Self-executing code on a blockchain', 'is_correct' => true],
                    ['text' => 'A legal agreement for cryptocurrency', 'is_correct' => false],
                    ['text' => 'A type of cryptocurrency wallet', 'is_correct' => false],
                    ['text' => 'A trading algorithm', 'is_correct' => false],
                ]
            ],
            [
                'question' => 'What does DeFi stand for?',
                'answers' => [
                    ['text' => 'Decentralized Finance', 'is_correct' => true],
                    ['text' => 'Digital Finance', 'is_correct' => false],
                    ['text' => 'Distributed Finance', 'is_correct' => false],
                    ['text' => 'Direct Finance', 'is_correct' => false],
                ]
            ],
            [
                'question' => 'Which of these is NOT a cryptocurrency?',
                'answers' => [
                    ['text' => 'PayPal', 'is_correct' => true],
                    ['text' => 'Ethereum', 'is_correct' => false],
                    ['text' => 'Cardano', 'is_correct' => false],
                    ['text' => 'Polkadot', 'is_correct' => false],
                ]
            ],
            [
                'question' => 'What is a blockchain?',
                'answers' => [
                    ['text' => 'A distributed digital ledger', 'is_correct' => true],
                    ['text' => 'A type of cryptocurrency', 'is_correct' => false],
                    ['text' => 'A centralized database', 'is_correct' => false],
                    ['text' => 'A programming language', 'is_correct' => false],
                ]
            ],
            [
                'question' => 'What is a private key used for in cryptocurrency?',
                'answers' => [
                    ['text' => 'To access and manage your funds', 'is_correct' => true],
                    ['text' => 'To mine new blocks', 'is_correct' => false],
                    ['text' => 'To verify transactions', 'is_correct' => false],
                    ['text' => 'To create a new cryptocurrency', 'is_correct' => false],
                ]
            ],
            [
                'question' => 'What is the purpose of a hardware wallet?',
                'answers' => [
                    ['text' => 'To store crypto keys offline for security', 'is_correct' => true],
                    ['text' => 'To mine cryptocurrency faster', 'is_correct' => false],
                    ['text' => 'To analyze market trends', 'is_correct' => false],
                    ['text' => 'To validate blockchain transactions', 'is_correct' => false],
                ]
            ],
            [
                'question' => 'What is staking in cryptocurrency?',
                'answers' => [
                    ['text' => 'Locking up coins to support network operations', 'is_correct' => true],
                    ['text' => 'Selling all your coins at once', 'is_correct' => false],
                    ['text' => 'Buying coins at regular intervals', 'is_correct' => false],
                    ['text' => 'Trading between different cryptocurrencies', 'is_correct' => false],
                ]
            ],
            [
                'question' => 'What is a DAO?',
                'answers' => [
                    ['text' => 'Decentralized Autonomous Organization', 'is_correct' => true],
                    ['text' => 'Digital Asset Offering', 'is_correct' => false],
                    ['text' => 'Distributed Application Outline', 'is_correct' => false],
                    ['text' => 'Data Analysis Option', 'is_correct' => false],
                ]
            ],
            [
                'question' => 'What is a gas fee in Ethereum?',
                'answers' => [
                    ['text' => 'The cost to process a transaction', 'is_correct' => true],
                    ['text' => 'A subscription for Ethereum users', 'is_correct' => false],
                    ['text' => 'A tax on crypto profits', 'is_correct' => false],
                    ['text' => 'The reward for mining a block', 'is_correct' => false],
                ]
            ],
            [
                'question' => 'Which of these is a layer 2 scaling solution?',
                'answers' => [
                    ['text' => 'Optimism', 'is_correct' => true],
                    ['text' => 'Solana', 'is_correct' => false],
                    ['text' => 'Cardano', 'is_correct' => false],
                    ['text' => 'Avalanche', 'is_correct' => false],
                ]
            ]
        ];

        $now = now();
        $quizzesToInsert = [];
        $answersToInsert = [];

        foreach ($quizData as $index => $data) {
            $quizzesToInsert[] = [
                'question' => $data['question'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        Quiz::insert($quizzesToInsert);

        $insertedQuizzes = Quiz::orderBy('id')->take(count($quizData))->get();
        
        foreach ($insertedQuizzes as $i => $quiz) {
            foreach ($quizData[$i]['answers'] as $answer) {
                $answersToInsert[] = [
                    'quiz_id' => $quiz->id,
                    'text' => $answer['text'],
                    'is_correct' => $answer['is_correct'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        QuizAnswer::insert($answersToInsert);
    }
}