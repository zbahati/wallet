<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\TransactionImport;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $totalDeposits = Transaction::where('user_id', $user->id)->where('type', 'deposit')
            ->sum('amount');
        $totalWithdrawals = Transaction::where('user_id', $user->id)->where('type', 'withdrawal')
            ->sum('amount');
        $balance =  $totalDeposits - $totalWithdrawals;

        return view('transaction.index', compact('totalDeposits', 'totalWithdrawals', 'balance'));
    }

    public function allTransactions()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $transactions = Transaction::where('user_id', $user->id)->get();
        return view('transaction.transactions', ['transactions' => $transactions]);
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'transactions.xlsx');
    }

    public function showImportForm()
    {
        return view('transaction.import-form');
    }

    public function import(Request $request)
    {
        // Validate the file upload
        $request->validate([
            'excel-file' => 'required|mimes:xlsx,xls,csv',  // Check file type to ensure it's an Excel file
        ]);;
        // Import the Excel file using the TransactionImport class
        Excel::import(new TransactionImport, $request->file('excel-file'));

        // Optionally, return a success message
        return redirect()->route('transaction.index')->with('success', 'Transactions imported successfully!');
    }

    public function create()
    {
        return view('transaction.create-transaction');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:deposit,withdrawal',
            'description' => 'nullable|string'
        ]);

        $user = Auth::user();

        // Get total deposits and withdrawals
        $totalDeposits = Transaction::where('user_id', $user->id)->where('type', 'deposit')->sum('amount');
        $totalWithdrawals = Transaction::where('user_id', $user->id)->where('type', 'withdrawal')->sum('amount');

        // Calculate balance
        $balance = $totalDeposits - $totalWithdrawals;

        // Check if withdrawal is greater than balance
        if ($request->type === 'withdrawal' && $request->amount > $balance) {
            return back()->withErrors(['amount' => 'Insufficient balance. You only have ' . number_format($balance, 2) . ' RWF available.']);
        }

        // Store transaction
        Transaction::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return back()->with('success', ucfirst($request->type) . ' transaction of ' . number_format($request->amount, 2) . ' RWF recorded successfully.');
    }


    public function show(Transaction $transaction)
    {
        //
    }


    public function edit(Transaction $transaction)
    {
        //
    }


    public function update(Request $request, Transaction $transaction)
    {
        //
    }


    public function destroy(Transaction $transaction)
    {
        //
    }
}
