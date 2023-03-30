<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_name' => $this->faker->name(),
            'unit_id' => rand(1, 2),
            'position_id' => rand(1,2),
            'date_join'=> $this->faker->unixTime(new DateTime('+3 weeks')),
            'user_id'=> '',
            'foto' => ''
        ];
    }
}
