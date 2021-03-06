<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->all());

        $response = Http::get('https://verify.smspoh.com/api/v1/request', [
            "access-token" => env('SMSPOH_TOKEN'),
            "number" => $user->phone,
            "brand_name" => "BFF Sports",
            "code_length" => 6,
            "sender_name" => "BFF Sports",
            "template" => "{brand_name} အတွက် သင်၏အတည်ပြုရန်ကုဒ်နံပါတ်မှာ {code} ဖြစ်ပါတယ်",
        ]);

        return response()->json([
            'success' => true,
            'flag' => 'verify_otp',
            'message' => 'User account created',
            'data' => $user,
            'extra' => $response->json()
        ], 200);
    }
}
