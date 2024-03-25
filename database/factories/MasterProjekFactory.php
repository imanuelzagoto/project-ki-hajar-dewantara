<?php

namespace Database\Factories;

use App\Models\MasterProjek;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class MasterProjekFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MasterProjek::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start = $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d');
        $deadline = $this->faker->dateTimeBetween($start, '+1 year')->format('Y-m-d H:i:s');
        $end = $this->faker->dateTimeBetween($deadline, '+1 year')->format('Y-m-d');

        return [
            'project_name' => $this->faker->sentence,
            'code_project' => $this->faker->word,
            'deadline' => $deadline,
            'start' => $start,
            'end' => $end,
        ];
    }
}
