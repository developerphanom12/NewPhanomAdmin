<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banner::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'image_path' => 'banners/test-banner-' . fake()->randomNumber(3) . '.jpg',
            'link_url' => fake()->url(),
            'is_active' => true,
            'order' => fake()->numberBetween(1, 10),
            'banner_type' => 'promotional',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the banner is inactive.
     *
     * @return static
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
} 