<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Transaction;
use App\Services\LogServices;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $logServices;
    public function __construct(LogServices $logServices)
    {
        $this->logServices = $logServices;
    }
    public function index()
    {
        $studentsCount = Student::count();
        $transactionCount = Transaction::count();
        $logs = $this->logServices->getLogs();

        $statuses = ['menunggu pembayaran', 'menunggu acc', 'proses legalisir', 'pengiriman', 'selesai', 'ditolak'];

        $dates = collect(range(0, 6))->map(function ($i) {
            return Carbon::now()->subDays($i)->format('Y-m-d');
        });

        $transactionsPerDay = $dates->mapWithKeys(function ($date) use ($statuses) {
            $data = [];
            foreach ($statuses as $status) {
                $data[$status] = Transaction::whereDate('created_at', $date)
                    ->where('status', $status)
                    ->count();
            }
            return [$date => $data];
        });

        return view('superadmin.index', [
            'studentsCount' => $studentsCount,
            'transactionCount' => $transactionCount,
            'dates' => $dates,
            'transactionsPerDay' => $transactionsPerDay,
            'statuses' => $statuses,
            'logs' => $logs,
        ]);
    }
}
