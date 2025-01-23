<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $admins = User::where('role', 'admin')->get();

            return view('admin.index', ['users' => $admins]);
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->warningBanner('Request Processing Error: '.$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create', ['user' => Auth::user()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|string|email',
                'title' => 'required|string',
                'message' => 'required|string',
            ]);

            if($validator->fails()){
                return back()->withInput()->warningBanner($validator->errors()->first());      
            }

            if(User::create($request->all())){

                return redirect()->route('dashboard')->banner('Message sent successfully.');
            }
            return back()->withInput()->warningBanner("Failed to sent message.");

        } catch (\Exception $e) {
            return back()->withInput()->dangerBanner('Request Processing Error: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
