<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Grant;

class PersonalFilingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $status=null)
    {
        try {
            if (isset($status)) {
                $records = Grant::where('status', $status)->get();
            } else {
                $records = Grant::all();
            }

            return view('personal-filing.index', ['records' => $records]);
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->warningBanner('Request Processing Error: '.$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('personal-filing.create', ['user' => Auth::user()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();

            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'age' => 'required|string',
                'address' => 'required|string',
                'phone_no' => 'required|string',
                'email' => 'required|string|email',

                'grant_purpose' => 'required|string',
                'idea_short_description' => 'required|string',
                
                'expected_funding' => 'required|string',
                'payment_means' => 'required|string',
                'fund_use_cases' => 'required|array',

                'issued_id_front' => ['nullable', 'mimes:jpg,jpeg,png', 'max:20480'],
                'issued_id_back' => ['nullable', 'mimes:jpg,jpeg,png', 'max:20480'],
                'ssn_or_tin' => 'required|string',

                'campaign' => 'nullable|string',
                'received_grants_before' => 'required|string',
                'past_grants_details' => 'nullable|string',

                'certification_name' => 'required|string',
                'certification_date' => 'required|string',
            ]);

            if($validator->fails()){
                return back()->withInput()->warningBanner($validator->errors()->first());      
            }

            $id_card_front = $request->file('issued_id_front')->storePublicly('id-cards', ['disk' => 'public']);
            $id_card_back = $request->file('issued_id_back')->storePublicly('id-cards', ['disk' => 'public']);

            $fund_use_cases = '';
            if ($request->fund_use_cases) {
                $fund_use_cases = json_encode($request->fund_use_cases);
            }

            if(Grant::create(array_merge($request->all(),[
                'user_id' => $user->id,
                'full_name' => $request->name,
                'issued_id_front_path' => $id_card_front,
                'issued_id_back_path' => $id_card_back,
                'status' => 'pending',
                'fund_use_cases' => $fund_use_cases
            ]))){

                return redirect()->route('dashboard')->banner('Application submitted successfully.');
            }
            return back()->withInput()->warningBanner("Failed to submit application.");

        } catch (\Exception $e) {
            return back()->withInput()->dangerBanner('Request Processing Error: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        try {
            $user = Auth::user();

            $grant = Grant::where('id', $uuid)->first();
            if ($grant) {
                if ($user->id == $grant->user->id || $user->role == 'admin'){
                    return view('grant.show', ['grant' => $grant]);
                }
                return redirect()->route('dashboard')->warningBanner('You are not authorized to view this resource.');
            }

            return redirect()->route('dashboard')->warningBanner('User does not exist.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->warningBanner('Request Processing Error: '.$e->getMessage());
        }
    }

    public function updateVlink(Request $request, string $uuid)
    {
        try {
            $validator = Validator::make($request->all(), [
                'verification_url' => 'required|string|url',
            ]);

            if($validator->fails()){
                return back()->withInput()->warningBanner($validator->errors()->first());      
            }

            $grant = Grant::where('id', $uuid)->first();
            if ($grant) {
                $grant->verification_url = $request->verification_url;
                $grant->status = "awaiting_verification";
                $grant->save();

                return redirect()->back()->banner('Verification url updated successfully.');
            }
            return back()->withInput()->warningBanner("Failed to update verification url.");
        } catch (\Exception $e) {
            return back()->withInput()->dangerBanner('Request Processing Error: '.$e->getMessage());
        }
    }

    public function updateStatus(string $uuid, string $status)
    {
        try {
            $grant = Grant::where('id', $uuid)->first();
            if ($grant) {
                $grant->status = $status;
                $grant->save();

                return redirect()->back()->banner('Status updated successfully.');
            }
            return back()->withInput()->warningBanner("Failed to update status.");
        } catch (\Exception $e) {
            return back()->withInput()->dangerBanner('Request Processing Error: '.$e->getMessage());
        }
    }

    public function updateVProof(Request $request, string $uuid)
    {
        try {
            $validator = Validator::make($request->all(), [
                'verification_proof' => ['nullable', 'mimes:jpg,jpeg,png', 'max:20480'],
            ]);

            if($validator->fails()){
                return back()->withInput()->warningBanner($validator->errors()->first());      
            }

            $grant = Grant::where('id', $uuid)->first();
            if ($grant) {
                $verification_proof = $request->file('verification_proof')->storePublicly('verification-proof', ['disk' => 'public']);

                $grant->verification_proof_path = $verification_proof;
                $grant->save();

                return redirect()->back()->banner('Proof of Verification uploaded successfully.');
            }
            return back()->withInput()->warningBanner("Failed to upload proof of verification.");
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
        try {
            $user = Grant::where('id', $id)->first();

            if (!$user) {
                // return $this->error('User not found.', 404);
            }

            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->save();

            // return $this->success("Grant updated successfully.", $user);
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->dangerBanner('Request Processing Error: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
