<?php

namespace Database\Seeders;

use App\Models\Letter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LetterSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $letters = [
            [
                'message' => 'Хочу найти свою вторую половинку и обрести счастье в любви.',
                'payment_status' => 'paid',
            ],
            [
                'message' => 'Мечтаю о финансовом благополучии и стабильности для своей семьи.',
                'payment_status' => 'paid',
            ],
            [
                'message' => 'Прошу здоровья и долголетия для моих близких.',
                'payment_status' => 'pending',
            ],
            [
                'message' => 'Хочу успешно сдать экзамены и поступить в университет мечты.',
                'payment_status' => 'paid',
            ],
            [
                'message' => 'Мечтаю о путешествии в страну, которую всегда хотел посетить.',
                'payment_status' => 'paid',
            ],
            [
                'message' => 'Прошу помощи в поиске работы, которая принесет мне удовлетворение.',
                'payment_status' => 'pending',
            ],
            [
                'message' => 'Хочу, чтобы мои дети были счастливы и здоровы.',
                'payment_status' => 'paid',
            ],
            [
                'message' => 'Мечтаю о мире и гармонии в отношениях с близкими.',
                'payment_status' => 'paid',
            ],
            [
                'message' => 'Прошу сил и мудрости для преодоления трудностей.',
                'payment_status' => 'pending',
            ],
            [
                'message' => 'Хочу реализовать свою мечту и стать тем, кем всегда мечтал быть.',
                'payment_status' => 'paid',
            ],
        ];

        foreach ($letters as $letter) {
            Letter::create($letter);
        }

        $this->command->info('Создано ' . count($letters) . ' писем.');
    }
}
