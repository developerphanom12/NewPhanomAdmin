<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::factory()->count(5)->create(['category' => 'General']);
        Faq::factory()->count(4)->create(['category' => 'Account']);
        Faq::factory()->count(3)->create(['category' => 'Payments']);
        Faq::factory()->count(3)->create(['category' => 'Shipping']);
        
        // Create some specific FAQs
        Faq::factory()->create([
            'question' => 'How do I create an account?',
            'answer' => 'You can create an account by clicking on the "Sign Up" button at the top right corner of the website. Fill in your details and follow the verification process to complete your registration.',
            'category' => 'Account',
            'order' => 1,
            'is_active' => true,
        ]);
        
        Faq::factory()->create([
            'question' => 'What payment methods do you accept?',
            'answer' => 'We accept credit cards (Visa, MasterCard, American Express), PayPal, and bank transfers. All transactions are secure and encrypted.',
            'category' => 'Payments',
            'order' => 1,
            'is_active' => true,
        ]);
        
        Faq::factory()->create([
            'question' => 'How long does shipping take?',
            'answer' => 'Standard shipping typically takes 3-5 business days within the country and 7-14 business days for international orders. Express shipping options are available at checkout for faster delivery.',
            'category' => 'Shipping',
            'order' => 1,
            'is_active' => true,
        ]);
    }
}
