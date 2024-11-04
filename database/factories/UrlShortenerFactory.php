<?php

namespace Database\Factories;

use App\Models\UrlShortener;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UrlShortenerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UrlShortener::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'         => User::factory()->create()->id,
            'original_url'    => $this->faker->url(),
            'clicks'          => $this->faker->numberBetween(0, 1000),
            'last_clicked_at' => $this->faker->optional(0.7)->dateTimeBetween('-1 month'),
            'created_at'      => $this->faker->dateTimeBetween('-6 months'),
            'updated_at'      => function (array $attributes) {
                return $this->faker->dateTimeBetween($attributes['created_at']);
            },
        ];
    }
}
