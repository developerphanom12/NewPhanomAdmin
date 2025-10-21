<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller {
    // GET /api/test/status
    public function status(Request $req){
        $profile = $req->user()->freelancerProfile ?? null;
        return response()->json(['ok'=>true,'test_given'=>($profile->test_given ?? false)]);
    }

    // POST /api/test/submit  (for example, after user finishes test)
    public function submit(Request $req){
        $profile = $req->user()->freelancerProfile ?? null;
        if(!$profile) return response()->json(['ok'=>false,'message'=>'No profile'],404);

        // Here you might store results; for now just mark true
        $profile->update(['test_given'=>true]);
        return response()->json(['ok'=>true,'profile'=>$profile]);
    }
}
