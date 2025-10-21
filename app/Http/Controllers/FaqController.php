<?php

namespace App\Http\Controllers;

use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use App\Repositories\FaqRepository;
use Illuminate\Http\Request;

class FaqController extends Controller
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
     * Display a listing of the FAQs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = $this->faqRepository->getAllFaqs();
        return view('screen.faqs.faqs', compact('faqs'));
    }

    /**
     * Show the form for creating a new FAQ.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('screen.faqs.createfaqs');
    }

    /**
     * Store a newly created FAQ in storage.
     *
     * @param  \App\Http\Requests\FaqRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        $this->faqRepository->createFaq($request->validated());
        return redirect()->route('faq.index')->with('success', 'FAQ created successfully');
    }

    /**
     * Display the specified FAQ.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return view('screen.faqs.showfaq', compact('faq'));
    }

    /**
     * Show the form for editing the specified FAQ.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('screen.faqs.editfaqs', compact('faq'));
    }

    /**
     * Update the specified FAQ in storage.
     *
     * @param  \App\Http\Requests\FaqRequest  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        $this->faqRepository->updateFaq($faq, $request->validated());
        return redirect()->route('faq.index')->with('success', 'FAQ updated successfully');
    }

    /**
     * Remove the specified FAQ from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $this->faqRepository->deleteFaq($faq);
        return redirect()->route('faq.index')->with('success', 'FAQ deleted successfully');
    }
    
    /**
     * Display a listing of the deleted FAQs.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted()
    {
        $faqs = $this->faqRepository->getDeletedFaqs();
        return view('screen.faqs.deletedfaqs', compact('faqs'));
    }
    
    /**
     * Restore the specified FAQ.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $this->faqRepository->restoreFaq($id);
        return redirect()->route('faq.deleted')->with('success', 'FAQ restored successfully');
    }
    
    /**
     * Permanently delete the specified FAQ.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forceDelete($id)
    {
        $this->faqRepository->permanentlyDeleteFaq($id);
        return redirect()->route('faq.deleted')->with('success', 'FAQ permanently deleted');
    }
    
    /**
     * Toggle the active status of a FAQ.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus(Faq $faq)
    {
        $this->faqRepository->updateFaq($faq, [
            'is_active' => !$faq->is_active
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'is_active' => !$faq->is_active
        ]);
    }
}
