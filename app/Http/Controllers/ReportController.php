<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $thisWeek = [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];
        $thisMonth = [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()];

        $dailyOmset = Transaction::whereDate('created_at', $today)->sum('total_amount');
        $weeklyOmset = Transaction::whereBetween('created_at', $thisWeek)->sum('total_amount');
        $monthlyOmset = Transaction::whereBetween('created_at', $thisMonth)->sum('total_amount');

        $transactions = Transaction::with('customer')->latest()->take(10)->get();

        return view('reports.index', compact('dailyOmset', 'weeklyOmset', 'monthlyOmset', 'transactions'));
    }
}
