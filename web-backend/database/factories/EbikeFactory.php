<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ebike;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;

class EbikeFactory extends Factory
{
    protected $model = Ebike::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'id' => $this->faker->unique(true)->randomDigitNotNull,
            'brand' => $this->faker->company,
            'odometer' => $this->faker->numberBetween($min = 20, $max = 5000),
        ];
    }
}
