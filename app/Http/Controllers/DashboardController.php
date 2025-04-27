<?php

namespace App\Http\Controllers;

use App\Models\PatienRegistration;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Count all patients registered for hospital service
        $patient_register_today = PatienRegistration::whereDate('created_at', now())->count();
        $patient_register_month = PatienRegistration::whereMonth('created_at', now()->month)->count();

        // revenue today
        $todayRevenue = Transaction::select(DB::raw('SUM(treatments.fee * transactions.amount) as total'))
            ->join('treatments', 'transactions.treatment_id', '=', 'treatments.id')
            ->whereDate('transactions.created_at', Carbon::today())
            ->value('total');

        // Revenue for last month
        $lastMonthRevenue = Transaction::select(DB::raw('SUM(treatments.fee * transactions.amount) as total'))
            ->join('treatments', 'transactions.treatment_id', '=', 'treatments.id')
            ->whereYear('transactions.created_at', now()->year)
            ->whereMonth('transactions.created_at', now()->month)
            ->value('total');

        return view('dashboard', [
            'title' => 'Dashboard',
            'patient_register_today' => $patient_register_today,
            'patiet_register_month' => $patient_register_month,
            'todayRevenue' => $todayRevenue,
            'lastMonthRevenue' => $lastMonthRevenue,
        ]);
    }
}
