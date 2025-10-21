<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CountryService
{
    public function getCountries()
    {
        return Cache::remember('countries', 86400, function () {
            $response = Http::get('https://restcountries.com/v3.1/all');
            
            if ($response->successful()) {
                $countries = collect($response->json())
                    ->map(function ($country) {
                        return [
                            'name' => $country['name']['common'],
                            'code' => $country['cca2']
                        ];
                    })
                    ->sortBy('name')
                    ->values()
                    ->toArray();
                
                return $countries;
            }
            
            return [];
        });
    }
} 