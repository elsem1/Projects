<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\EmployerFactory;
use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Employer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $employers = collect();

        $totalJobs = 200;

        for ($i = 0; $i < $totalJobs; $i++) {

            $numEmployers = count($employers);
            if ($numEmployers === 0 || rand(0, 1) === 1) {
                $employer = Employer::factory()->create();
                $employers->push($employer);
            } else {
                $employer = $employers->random();
            }

            Job::factory()->create([
                'employer_id' => $employer->id,
            ]);
        }

    }
}
