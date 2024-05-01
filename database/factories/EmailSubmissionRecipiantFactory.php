<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\EmailSubmission;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmailSubmissionRecipiant>
 */
class EmailSubmissionRecipiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $randomEmailSubmission = EmailSubmission::inRandomOrder()->first();

        return [
            'email_submission_id' => $randomEmailSubmission->id,
            'email' => fake()->email()
        ];
    }
}
