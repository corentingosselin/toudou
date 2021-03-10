<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'username' => $this->faker->unique()->userName,
            'name' => $this->faker->lastName,
            'surname' => $this->faker->firstName,
            'password' => Hash::make($this->faker->password()),
            'remember_token' => Str::random(10),
        ];
    }

    /**
 * Indicate that the user is suspended.
 *
 * @return \Illuminate\Database\Eloquent\Factories\Factory
 */
public function passwordKnown()
{
    return $this->state(function (array $attributes) {
        return [
            'name' => 'IKnowYou',
            'password' => Hash::make('marsatak'),
        ];
    });
}
}
