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
<<<<<<< HEAD
            'status' => $this->faker->randomElement(["en_cours","en_attente","traite","rejete"]),
            'objet'=>$this->faker->word(),
            'contenu' => $this->faker->text,
            'auteur_id' => User::factory(),
=======
            'status'=>'en_attente',
            'objet'=>$this->faker->word(),
            'auteur_id'=>User::factory(),
            'contenu' => $this->faker->text(),
            'feedback'=> null
>>>>>>> a0db9d6fd5a31e336cf23ebf81d7f00d697d1195
        ];
    }
}
