<?php

namespace Database\Factories;

use App\Models\Entry;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $questionIDs = Question::pluck('id');
        $ids = Entry::pluck('id');

        return [
            'question_id' => $questionIDs->random(),
            'answer' => $this->faker->realText(50),
            'entry_id' => $ids->random(),
        ];
    }
}
