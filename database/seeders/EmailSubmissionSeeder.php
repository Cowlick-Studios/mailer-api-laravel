<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\EmailSubmission;
use App\Models\EmailSubmissionField;
use App\Models\EmailSubmissionRecipiant;

class EmailSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmailSubmission::factory(10)->create();

        $allEmailSubmissions = EmailSubmission::all();

        foreach($allEmailSubmissions as $emailSubmission){
            EmailSubmissionField::factory(3)->create([
                'email_submission_id' => $emailSubmission->id,
            ]);

            EmailSubmissionRecipiant::factory(1)->create([
                'email_submission_id' => $emailSubmission->id,
            ]);
        }
    }
}
