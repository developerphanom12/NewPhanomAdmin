<?php

namespace Tests\Feature;

use App\Models\Banner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BannerApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test getting active banners.
     *
     * @return void
     */
    public function testGetActiveBanners()
    {
        // Create active banners with different priorities
        Banner::factory()->create([
            'title' => 'Banner 1',
            'order' => 2,
            'is_active' => true,
        ]);
        
        Banner::factory()->create([
            'title' => 'Banner 2',
            'order' => 1, // Lower priority, should be first
            'is_active' => true,
        ]);
        
        // Create an inactive banner that should not be returned
        Banner::factory()->create([
            'title' => 'Inactive Banner',
            'order' => 3,
            'is_active' => false,
        ]);

        // Make the API request
        $response = $this->getJson('/api/banners');

        // Assert successful response
        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                ])
                ->assertJsonCount(2, 'data')
                ->assertJsonPath('data.0.title', 'Banner 2') // First banner should be the one with lower priority
                ->assertJsonPath('data.1.title', 'Banner 1');

        // Assert inactive banner is not included
        $response->assertJsonMissing([
            'title' => 'Inactive Banner',
        ]);
    }
} 