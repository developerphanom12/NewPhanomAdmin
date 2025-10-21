<?php

namespace Tests\Feature;

use App\Models\Faq;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FaqTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test API can get all active FAQs.
     */
    public function test_api_can_get_all_active_faqs(): void
    {
        // Create some FAQs
        Faq::factory()->count(5)->create(['is_active' => true]);
        Faq::factory()->count(2)->create(['is_active' => false]);
        
        // Make API request
        $response = $this->getJson('/api/faqs');
        
        // Assert successful response
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'category',
                        'faqs' => [
                            '*' => [
                                'id',
                                'question',
                                'answer'
                            ]
                        ]
                    ]
                ]
            ])
            ->assertJson([
                'success' => true
            ]);
            
        // Check that only active FAQs are returned
        $responseData = $response->json('data');
        $totalFaqs = 0;
        foreach ($responseData as $category) {
            $totalFaqs += count($category['faqs']);
        }
        $this->assertEquals(5, $totalFaqs);
    }
    
    /**
     * Test API can get FAQs by category.
     */
    public function test_api_can_get_faqs_by_category(): void
    {
        // Create FAQs with different categories
        Faq::factory()->count(3)->create([
            'category' => 'General',
            'is_active' => true
        ]);
        
        Faq::factory()->count(2)->create([
            'category' => 'Account',
            'is_active' => true
        ]);
        
        // Make API request for a specific category
        $response = $this->getJson('/api/faqs/category/General');
        
        // Assert successful response
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'question',
                        'answer'
                    ]
                ]
            ])
            ->assertJson([
                'success' => true
            ]);
            
        // Verify correct count of FAQs in the specified category
        $this->assertCount(3, $response->json('data'));
    }
    
    /**
     * Test web interface can create a new FAQ.
     */
    public function test_can_create_faq(): void
    {
        // Create FAQ data
        $faqData = [
            'question' => 'Test Question?',
            'answer' => 'Test Answer',
            'category' => 'Test Category',
            'order' => 1,
            'is_active' => true
        ];
        
        // Submit form to create FAQ
        $response = $this->post(route('faq.store'), $faqData);
        
        // Assert successful redirect
        $response->assertRedirect(route('faq.index'))
            ->assertSessionHas('success', 'FAQ created successfully');
        
        // Verify FAQ was created in database
        $this->assertDatabaseHas('faqs', [
            'question' => 'Test Question?',
            'category' => 'Test Category'
        ]);
    }
    
    /**
     * Test web interface can update an existing FAQ.
     */
    public function test_can_update_faq(): void
    {
        // Create a FAQ
        $faq = Faq::factory()->create();
        
        // Update data
        $updatedData = [
            'question' => 'Updated Question?',
            'answer' => 'Updated Answer',
            'category' => 'Updated Category',
            'order' => 2,
            'is_active' => false
        ];
        
        // Submit form to update FAQ
        $response = $this->put(route('faq.update', $faq), $updatedData);
        
        // Assert successful redirect
        $response->assertRedirect(route('faq.index'))
            ->assertSessionHas('success', 'FAQ updated successfully');
        
        // Verify FAQ was updated in database
        $this->assertDatabaseHas('faqs', [
            'id' => $faq->id,
            'question' => 'Updated Question?',
            'category' => 'Updated Category',
            'is_active' => 0
        ]);
    }
    
    /**
     * Test web interface can delete a FAQ.
     */
    public function test_can_delete_faq(): void
    {
        // Create a FAQ
        $faq = Faq::factory()->create();
        
        // Submit delete request
        $response = $this->delete(route('faq.destroy', $faq));
        
        // Assert successful redirect
        $response->assertRedirect(route('faq.index'))
            ->assertSessionHas('success', 'FAQ deleted successfully');
        
        // Verify FAQ was soft deleted (not completely removed)
        $this->assertSoftDeleted('faqs', [
            'id' => $faq->id
        ]);
    }
}
