<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\privacyPolicy;

class PrivacyController extends Controller
{
    public function showPrivacy()
    {
        $policy = privacyPolicy::where('key', 'privacy_policy')->first();
        return view('screen.setting.privacy', ['policy' => $policy]);
    }
    public function showPrivacyPolicy(){
        $policy = privacyPolicy::where('key', 'privacy_policy')->first();
        return $policy;
    }
    public function updatePrivacy(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        privacyPolicy::updateOrCreate(
            ['key' => 'privacy_policy'],
            ['value' => $request->input('content')]
        );

        return redirect()->back()->with('success', 'Privacy Policy updated successfully!');
    }

    
}
