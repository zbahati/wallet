<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('All Transactions') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('transaction.create') }}" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    Add New Transaction
                </a>
                <a href="{{ route('transactions.export') }}" 
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    Export to Excel
                </a>
                 <a href="{{ route('transactions.import-form') }}" 
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    import to database
                </a>
            </div>
        </div>
    </x-slot>

   <div class="py-12">
     <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
            <thead class="bg-gray-200 dark:bg-gray-700">
                <tr class="text-left text-gray-600 dark:text-gray-300">
                    <th class="px-4 py-3 border border-gray-300 dark:border-gray-600">Transaction Type</th>
                    <th class="px-4 py-3 border border-gray-300 dark:border-gray-600">Amount</th>
                    <th class="px-4 py-3 border border-gray-300 dark:border-gray-600">Description</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300 dark:divide-gray-700">
                @foreach ($transactions as $transaction)
                    
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                        <td class="px-4 py-3 border border-gray-300 dark:border-gray-600">{{ $transaction->type}}</td>
                        <td class="px-4 py-3 border border-gray-300 dark:border-gray-600">{{$transaction->amount}}</td>
                        <td class="px-4 py-3 border border-gray-300 dark:border-gray-600">{{$transaction->description}}</td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</x-app-layout>
