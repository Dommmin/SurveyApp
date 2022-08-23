<?php

namespace Database\Factories;

use App\Models\Survey;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $surveyIDs = Survey::pluck('id');

        return [
            'question' => str_replace('.', '?', $this->faker->realTextBetween(5, 20)),
            'survey_id' => $surveyIDs->random(),
            'data' => '{}',
            'type' => Survey::TYPE_TEXT
        ];
    }
}
