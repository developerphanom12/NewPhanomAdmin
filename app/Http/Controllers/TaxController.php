<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;
use App\Services\CountryService;

class TaxController extends Controller
{
    protected $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index()
    {
        $taxes = Tax::all();
        return view('screen.taxes.taxlist', compact('taxes'));
    }

    public function create()
    {
        $countries = $this->countryService->getCountries();
        return view('screen.taxes.createtax', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tax_title' => 'required|string|max:255',
            'country' => 'required|string|max:2',
            'tax_type' => 'required|in:fixed,percentage',
            'tax_amount' => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        Tax::create($validated);

        return redirect()->route('taxes.index')
            ->with('success', 'Tax created successfully.');
    }

    public function edit(Tax $tax)
    {
        $countries = $this->countryService->getCountries();
        return view('screen.taxes.edittax', compact('tax', 'countries'));
    }

    public function update(Request $request, Tax $tax)
    {
        $validated = $request->validate([
            'tax_title' => 'required|string|max:255',
            'country' => 'required|string|max:2',
            'tax_type' => 'required|in:fixed,percentage',
            'tax_amount' => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        $tax->update($validated);

        return redirect()->route('taxes.index')
            ->with('success', 'Tax updated successfully.');
    }

    public function destroy(Tax $tax)
    {
        $tax->delete();

        return redirect()->route('taxes.index')
            ->with('success', 'Tax deleted successfully.');
    }
} 