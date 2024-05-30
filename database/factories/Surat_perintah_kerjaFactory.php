<?php

namespace Database\Factories;

use App\Models\Surat_perintah_kerja;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class Surat_perintah_kerjaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Surat_perintah_kerja::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->word,
            'pemohon' => $this->faker->name,
            'applicant_name' => $this->faker->sentence,
            'user' => $this->faker->name,
            'main_contractor' => $this->faker->company,
            'project_manager' => $this->faker->name,
            'no_spk' => $this->faker->randomNumber(6),
            'tanggal' => $this->faker->date(),
            'prioritas' => $this->faker->randomElement(['High', 'Medium', 'Low']),
            'waktu_penyelesaian' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d H:i:s'),
            'pic' => $this->faker->name,
            'dokumen_pendukung_type' => null, // Mengabaikan pengisian nilai
            'dokumen_pendukung_file' => $this->faker->imageUrl(),
            'file_pendukung_lainnya' => $this->faker->imageUrl(),
        ];
    }
}
