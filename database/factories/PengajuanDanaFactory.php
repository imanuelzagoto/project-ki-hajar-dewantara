<?php

namespace Database\Factories;

use App\Models\PengajuanDana;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class PengajuanDanaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PengajuanDana::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_pemohon' => $this->faker->name,
            'subject' => $this->faker->sentence,
            'tujuan' => $this->faker->sentence,
            'lokasi' => $this->faker->city,
            'jangka_waktu' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'dana_yang_dibutuhkan' => $this->faker->numberBetween(100000, 1000000),
            'no_rekening' => $this->faker->bankAccountNumber,
            'catatan' => $this->faker->sentence,
            'tanggal' => $this->faker->date(),
            'no_doc' => $this->faker->word,
            'revisi' => $this->faker->randomDigitNotNull,
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
