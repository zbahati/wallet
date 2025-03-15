<?php

namespace App\Exports;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $user = Auth::user();
        return Transaction::with('user')->where('user_id', $user->id)->get(['type', 'amount', 'description']);
    }

    public function headings(): array
    {
        // Define the headers for your table
        return [
            'type',      // Column 1 header
            'amount',    // Column 2 header
            'description',      // Column 3 header
        ];
    }
}
