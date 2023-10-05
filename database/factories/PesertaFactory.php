<?php

namespace Database\Factories;
use App\Models\Peserta;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peserta>
 */
class PesertaFactory extends Factory
{
    protected $model = Peserta::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'nik' => $this->faker->unique()->randomNumber(9),
            'hp' => $this->faker->phoneNumber,
            'alamat' => $this->faker->address,
            'tgl_lahir' => $this->faker->date,
            'warna' => $this->faker->randomElement(['kuning', 'abu-abu', 'merah']),
            'perekrut' => $this->faker->word,
            'status' => $this->faker->randomElement(['relawan', 'simpatisan']),
        ];
    }
}
