<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'personal_number' => $this->faker->numberBetween($min = 1000000000, $max = 9999999999),
            'gender' =>  $this->faker->randomElement($array = array('M', 'F')),
            'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'address' => $this->faker->streetAddress,
            'residence' => $this->faker->cityPrefix,
            'city' => $this->faker->state,
            'phone' => $this->faker->numberBetween($min = 100000000, $max = 999999999),
            'email' => $this->faker->email,
        ];
    }
}
