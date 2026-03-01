<?php

namespace App\Http\Controllers;

use App\Http\Requests\profileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function CreateProfile(profileRequest $request)
    {
        $profile = Profile::create([
            ...$request->validated(),
            'user_id' => Auth::id()]);

        return response()->json([
            'message' => 'profile created successfully.',
            'profile' => $profile,
        ], 201);
    }
}
