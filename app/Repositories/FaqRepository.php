<?php

namespace App\Repositories;

use App\Models\Faq;

class FaqRepository
{
    /**
     * Get all FAQs sorted by order.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllFaqs()
    {
        return Faq::orderBy('order')->get();
    }
    
    /**
     * Get active FAQs sorted by order.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActiveFaqs()
    {
        return Faq::where('is_active', true)
            ->orderBy('order')
            ->get();
    }
    
    /**
     * Get deleted FAQs.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDeletedFaqs()
    {
        return Faq::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->get();
    }
    
    /**
     * Create a new FAQ.
     *
     * @param array $data
     * @return Faq
     */
    public function createFaq(array $data)
    {
        return Faq::create($data);
    }
    
    /**
     * Update an existing FAQ.
     *
     * @param Faq $faq
     * @param array $data
     * @return Faq
     */
    public function updateFaq(Faq $faq, array $data)
    {
        $faq->update($data);
        return $faq;
    }
    
    /**
     * Delete a FAQ.
     *
     * @param Faq $faq
     * @return boolean
     */
    public function deleteFaq(Faq $faq)
    {
        return $faq->delete();
    }
    
    /**
     * Permanently delete a FAQ.
     *
     * @param int $id
     * @return boolean
     */
    public function permanentlyDeleteFaq($id)
    {
        $faq = Faq::withTrashed()->findOrFail($id);
        return $faq->forceDelete();
    }
    
    /**
     * Restore a deleted FAQ.
     *
     * @param int $id
     * @return Faq
     */
    public function restoreFaq($id)
    {
        $faq = Faq::withTrashed()->findOrFail($id);
        $faq->restore();
        return $faq;
    }
    
    /**
     * Get FAQs by category.
     *
     * @param string $category
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFaqsByCategory($category)
    {
        return Faq::where('category', $category)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
    }
} 