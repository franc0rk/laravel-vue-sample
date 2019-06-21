<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function edit()
    {
        return view('user_profiles.edit');
    }

    public function update(Request $request)
    {
        auth()->user()->profile()->update($request->except(['_token', '_method']));

        return redirect()->route('user-address.edit');
    }
}
