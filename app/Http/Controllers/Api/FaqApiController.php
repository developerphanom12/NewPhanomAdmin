<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\FaqRepository;
use Illuminate\Http\Request;

class FaqApiController extends Controller
{
    /**
     * The FAQ repository instance.
     */
    protected $faqRepository;

    /**
     * Create a new controller instance.
     *
     * @param FaqRepository $faqRepository
     * @return void
     */
    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    /**
     * Get active FAQs ordered by category and priority.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getActiveFaqs()
    {
        $faqs = $this->faqRepository->getActiveFaqs();
        
        // Group by category
        $groupedFaqs = $faqs->groupBy('category');
        
        // Format response
        $formattedData = [];
        foreach ($groupedFaqs as $category => $categoryFaqs) {
            $formattedData[] = [
                'category' => $category ?: 'Uncategorized',
                'faqs' => $categoryFaqs->map(function($faq) {
                    return [
                        'id' => $faq->id,
                        'question' => $faq->question,
                        'answer' => $faq->answer,
                    ];
                })
            ];
        }
        
        return response()->json([
            'success' => true,
            'data' => $formattedData,
        ]);
    }
    
    /**
     * Get FAQs by category.
     *
     * @param string $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFaqsByCategory($category)
    {
        $faqs = $this->faqRepository->getFaqsByCategory($category);
        
        return response()->json([
            'success' => true,
            'data' => $faqs->map(function($faq) {
                return [
                    'id' => $faq->id,
                    'question' => $faq->question,
                    'answer' => $faq->answer,
                ];
            }),
        ]);
    }
}
