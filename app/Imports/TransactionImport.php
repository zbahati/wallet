<?php

namespace App\Imports;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class TransactionImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        if (isset($row[0]) && isset($row[1]) && isset($row[2])) {

            if (is_numeric($row[1]) && !empty($row[0])) {

                $user = Auth::user();
                $id = Transaction::count();

                return new Transaction([
                    'id' => $id + 1000,
                    'user_id' => $user->id,
                    'type' => $row[0],
                    'amount' => $row[1],
                    'description' => $row[2],
                ]);
            }
        }

        // If data is invalid, don't import it
        return null;
    }
}
