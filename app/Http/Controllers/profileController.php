<?php

namespace App\Http\Controllers;

use App\Http\Requests\profileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class profileController extends Controller
{


function CreateProfile(profileRequest $request){
  $profile =  Profile::create($request->validated());
  return response()->json([
    'message'=>'profile created successfully.',
    'profile'=>$profile
  ],201);
}

}
