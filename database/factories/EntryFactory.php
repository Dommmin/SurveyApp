<?php

namespace Database\Factories;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entry>
 */
class EntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $surveyIDs = Survey::pluck('id');
        $usersIDs = User::pluck('id');

        return [
            'survey_id' => $surveyIDs->random(),
            'participant_id' => $usersIDs->random()
        ];
    }
}
