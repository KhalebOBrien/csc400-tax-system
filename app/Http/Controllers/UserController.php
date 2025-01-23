<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Grant;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::where('role', 'user')->get();

            return view('user.index', ['users' => $users]);
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->warningBanner('Request Processing Error: '.$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        try {
            $user = User::where(['role' => 'user', 'id' => $uuid])->first();
            if ($user) {
                return view('user.show', ['user' => $user]);
            }

            return redirect()->route('dashboard')->warningBanner('User does not exist.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->warningBanner('Request Processing Error: '.$e->getMessage());
        }
    }

    public function updateStatus(string $uuid, string $status)
    {
        try {
            $user = User::where('id', $uuid)->first();
            
            if (empty($user)) {
                return redirect()->route('users')->warningBanner("User not found.");
            }

            if ($status == 'suspended' || $status == 'active') {
                $user->status = $status;
                $user->save();

                return redirect()->back()->banner('Status updated successfully.');
            }

            if ($status == 'delete') {
                $grants = Grant::where('user_id', $user->id)->get();
                foreach ($grants as $grant) {
                    $grant->delete();
                }

                $user->update(['email' => Str::random(6).'|'.$user->email ]);
                if($user->profile_photo_path != "profile-photos/default.png") {
                    $user->deleteProfilePhoto();
                }
                $user->tokens->each->delete();
                $user->delete();

                return redirect()->route('users')->banner('Status updated successfully.');
            }

            return back()->withInput()->warningBanner("Invalid request.");
        } catch (\Exception $e) {
            return back()->withInput()->dangerBanner('Request Processing Error: '.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
