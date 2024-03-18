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
        $mulai = $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d');
        $tenggat = $this->faker->dateTimeBetween($mulai, '+1 year')->format('Y-m-d H:i:s');
        $akhir = $this->faker->dateTimeBetween($tenggat, '+1 year')->format('Y-m-d');

        return [
            'nama_project' => $this->faker->sentence,
            'kode_project' => $this->faker->word,
            'tenggat' => $tenggat,
            'mulai' => $mulai,
            'akhir' => $akhir,
        ];
    }
}
