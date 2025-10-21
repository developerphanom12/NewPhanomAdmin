<?php

namespace Database\Factories;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Faq::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['General', 'Account', 'Payments', 'Orders', 'Shipping', 'Returns'];
        
        return [
            'question' => $this->faker->sentence(mt_rand(4, 8)) . '?',
            'answer' => $this->faker->paragraph(mt_rand(3, 7)),
            'order' => $this->faker->numberBetween(0, 100),
            'is_active' => $this->faker->boolean(80), // 80% chance of being active
            'category' => $this->faker->randomElement($categories),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
    
    /**
     * Indicate that the FAQ is active.
     *
     * @return static
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => true,
            ];
        });
    }
    
    /**
     * Indicate that the FAQ is inactive.
     *
     * @return static
     */
    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => false,
            ];
        });
    }
}
