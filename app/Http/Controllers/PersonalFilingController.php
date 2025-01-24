<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Grant;
use App\Models\PersonalFiling;
use Illuminate\Support\Str;
use Unicodeveloper\Paystack\Facades\Paystack;

class PersonalFilingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $status=null)
    {
        try {
            if (isset($status)) {
                $records = PersonalFiling::where('payment_status', $status)->get();
            } else {
                $records = PersonalFiling::all();
            }

            return view('personal-filing.index', ['records' => $records,
            'grantsCount' => 0,
            'pendingGrantsCount' => 0,
            'awaitingGrantsCount' => 0,
            'approvedGrantsCount' => 0,
            'rejectedGrantsCount' => 0,]);
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
                'income_amount' => 'required|string',
                'income_duration_start_date' => 'required|string',
                'income_duration_end_date' => 'required|string',
                'computed_tax_amount' => 'required|integer'
            ]);

            if($validator->fails()){
                return back()->withInput()->warningBanner($validator->errors()->first());      
            }

            $trxn_ref = 'PFT-'.Str::random(15);
            $paymentData = array(
                "amount" => $request->computed_tax_amount * 100,
                "reference" => $trxn_ref,
                "email" => $user->email,
                "currency" => "NGN",
                "callback_url" => route('payment.callback')
            );
            $paymentLink = Paystack::getAuthorizationUrl($paymentData);

            if(PersonalFiling::create(array_merge($request->all(),[
                'user_id' => $user->id,
                'trxn_ref' => $trxn_ref,
                'full_name' => $request->name,
                'income_amount' => $request->income_amount,
                'income_duration_start_date' => $request->income_duration_start_date,
                'income_duration_end_date' => $request->income_duration_end_date,
                'computed_tax_amount' => $request->computed_tax_amount,
                'payment_url' => $paymentLink->url
            ]))){
                return $paymentLink->redirectNow();
            }
            return back()->withInput()->warningBanner("Failed to submit filing.");

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
