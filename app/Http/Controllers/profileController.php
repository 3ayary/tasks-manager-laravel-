<?php

namespace App\Http\Controllers;

use App\Http\Requests\profileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function CreateProfile(profileRequest $request)
    {

        $validated = $request->validated();

        $validated['user_id'] = Auth::id();

        unset($validated['image']);

        if ($request->hasFile('image')) {

            $uploadedFile = Cloudinary()->uploadApi()->upload($request->file('image')->getRealPath(), ['folder' => 'profiles']);

            $validated['image'] = $uploadedFile->offsetGet('secure_url');

        }

        $profile = Profile::create($validated);

        return response()->json([
            'message' => 'profile created successfully.',
            'profile' => $profile,
        ], 201);
    }
}
