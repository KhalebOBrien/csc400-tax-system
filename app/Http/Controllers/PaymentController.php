<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\PersonalFiling;
use Illuminate\Support\Str;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    public function callback()
    {
        try {
            $paymentDetails = Paystack::getPaymentData();
    
            // dd($paymentDetails['data']);
            if ($paymentDetails['data']['reference'] !== null) {
                $refType = Str::startsWith($paymentDetails['data']['reference'], 'PFT-');

                if ($refType) {
                    $payment = PersonalFiling::where('trxn_ref', $paymentDetails['data']['reference'])->first();
    
                    if ($payment) {
                        $payment->payment_status = $paymentDetails['data']['gateway_response'];
                        // $payment->status = 'approved';
                        $payment->save();

                        return redirect()->route('filing.personal.index')->banner('Tax record filed successfully');
                    }
                }
            }
            
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->warningBanner('Request Processing Error: '.$e->getMessage());
        }
    }
}
