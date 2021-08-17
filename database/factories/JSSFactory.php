<?php

namespace Database\Factories;

use App\Models\JSS;
use Illuminate\Database\Eloquent\Factories\Factory;

class JSSFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JSS::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
//            'id' => 'JSS-' . $this->faker->regexify('[A-Z]{1}') . $this->faker->numerify(),
            'id' => $this->faker->bothify('JSS-?####'),
            'NIK' => $this->faker->numerify('#################'),
            'username' => $this->faker->userName(),
            'fullname' => $this->faker->name(),
            'password' => '$2y$10$X091UPR.dyjM1xwJTTxeDuwCLQq2A5ffGjRvwypXULLC5E2./e/tq',
            'email' => $this->faker->unique()->email(),
            'nomor_wa' => $this->faker->e164PhoneNumber(),
        ];
    }
}
