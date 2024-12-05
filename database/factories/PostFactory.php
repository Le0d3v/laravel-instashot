<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Elementos de la tabla Posts para tesgting
            "titulo" => $this->faker->sentence(5), // sentence() define la cantidad de caracteres
            "descripcion" => $this->faker->sentence(30),
            "imagen" => $this->faker->uuid() . ".jpg", // cadena aleatoria con terminacion (.jpg)
            "user_id" => $this->faker->randomElement([6, 7]) // seleccciona aleatoria entre los valores (6 y 7)
        ];
    }
}
