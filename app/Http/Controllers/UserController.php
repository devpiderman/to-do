<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        return (new UserResource(auth()->user()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request)
    {
        auth()->user()->update($request->validated());
        return response()->json([
            'message' => 'User Name Updated Successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        $user->delete();
        session()->invalidate();
        return response()->json([
            'message' => 'User Account Deleted Successfully.'
        ]);
    }
}
