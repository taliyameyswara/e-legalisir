<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionExports implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        return view('exports.transactions', [
            'transactions' => Transaction::with(
                'user', 'ijazah', 'transkrip', 'akta', 'province', 'city'
            )->get(),
        ]);
    }
}
