<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Auteur;
use App\Models\Demande;
use App\Models\User;

class DemandeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Demande::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement(["en_cours","en_attente","traite","rejete"]),
            'contenu' => $this->faker->text,
            'auteur_id' => User::factory(),
            'admin_id' => User::factory(),
        ];
    }
}
