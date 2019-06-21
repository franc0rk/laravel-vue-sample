<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function edit()
    {
        return view('user_addresses.edit');
    }

    public function update(Request $request)
    {
        auth()->user()->addresses()->first()->update($request->except(['_token', '_method']));

        return redirect()->route('app', 'home');
    }
}
