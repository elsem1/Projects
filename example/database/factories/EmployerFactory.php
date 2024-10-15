<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Job;
use App\Models\Employer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->lastName(),
            'company_name' => fake()->company(),
            'sector' => fake()->words(1, 3)

        ];
    }
}
//     public function configure()
// {
//     return $this->afterCreating(function (Employer $employer) {
//         Job::factory()->count(rand(0, 10))->create([
//             'employer_id' => $employer->id,
//         ]);
//     });
// }
// 