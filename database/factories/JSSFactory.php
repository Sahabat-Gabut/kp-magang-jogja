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
//        $faker = Factory::create('id_ID');
//        $faker = new Faker\Generator();
//        $faker->addProvider(new Faker\Provider\en_US\PhoneNumber($faker));
        return [
            'id' => strtoupper($this->faker->bothify('JSS-?####')),
            'NIK' => $this->faker->numerify('#################'),
            'username' => $this->faker->userName(),
            'fullname' => $this->faker->name(),
            'password' => '$2y$10$X091UPR.dyjM1xwJTTxeDuwCLQq2A5ffGjRvwypXULLC5E2./e/tq',
            'email' => $this->faker->email(),
            'no_wa' => $this->faker->phoneNumber('id_ID'),
        ];
    }
}
