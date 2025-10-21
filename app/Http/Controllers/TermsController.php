<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\termsCondition;
class TermsController extends Controller
{
     public function showPrivacy()
    {
        $policy = termsCondition::where('key', 'terms_conditions')->first();
        return view('screen.setting.condition', ['policy' => $policy]);
    }
    public function showTermCondition(){
        $policy = termsCondition::where('key', 'terms_conditions')->first();
        return $policy;
    }

    public function updatePrivacy(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        termsCondition::updateOrCreate(
            ['key' => 'terms_conditions'],
            ['value' => $request->input('content')]
        );

        return redirect()->back()->with('success', 'Terms and Condtions updated successfully!');
    }
}
