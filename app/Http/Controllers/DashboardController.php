<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Grant;
use App\Models\SupportMessage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            if ($user->role == 'user') {
                $grants = Grant::where('user_id', $user->id)->get();

                return view('dashboard-user', [
                    'grantsCount' => 0,
                    'pendingGrantsCount' => 0,
                    'awaitingGrantsCount' => 0,
                    'approvedGrantsCount' => 0,
                    'rejectedGrantsCount' => 0,
                ]);
            }

            if ($user->role == 'admin') {
                $grantsCount = Grant::count();
                $pendingGrantsCount = Grant::where('status', 'pending')->count();
                $awaitingGrantsCount = Grant::where('status', 'awaiting_verification')->count();
                $approvedGrantsCount = Grant::where('status', 'approved')->count();
                $rejectedGrantsCount = Grant::where('status', 'rejected')->count();

                $usersCount = User::where('role', 'user')->count();
                $adminsCount = User::where('role', 'admin')->count();

                $messagesCount = SupportMessage::count();

                return view('dashboard-admin', [
                    'grantsCount' => $grantsCount,
                    'pendingGrantsCount' => $pendingGrantsCount,
                    'awaitingGrantsCount' => $awaitingGrantsCount,
                    'approvedGrantsCount' => $approvedGrantsCount,
                    'rejectedGrantsCount' => $rejectedGrantsCount,

                    'usersCount' => $usersCount,
                    'adminsCount' => $adminsCount,

                    'messagesCount' => $messagesCount
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->warningBanner('Request Processing Error: '.$e->getMessage());
        }
    }
}
