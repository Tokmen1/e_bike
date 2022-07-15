<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EmployeeEbike;
use Illuminate\Support\Str;

class EmployeeEbikeFactory extends Factory
{
    protected $model = EmployeeEbike::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'id' => $this->faker->unique()->randomDigitNotNull,
            'employee_id' => $this->faker->unique(true)->randomDigitNot(0),
            'e_bike_id' => $this->faker->unique(true)->randomDigitNot(0),
            'date_from' => $this->faker->dateTimeBetween($startDate = '-22 years', $endDate = 'now'),//date($format = 'Y-m-d', $max = 'now', $min = '-2 years'),
            'date_to' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+2 years')//date($format = 'Y-m-d', $max = '+1 years', $min = 'now'),
        ];
    }
}
