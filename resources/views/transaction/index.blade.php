<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

     <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Deposit Card -->
                <div class="bg-white dark:bg-gray-800 mb-2 shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Deposits</h3>
                    <p class="text-2xl font-bold text-green-500 mt-2">{{ number_format($totalDeposits, 2) }} RWF</p>
                </div>

                <!-- Withdrawal Card -->
                <div class="bg-white dark:bg-gray-800 mb-2 shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Withdrawals</h3>
                    <p class="text-2xl font-bold text-red-500 mt-2">{{ number_format($totalWithdrawals, 2) }} RWF</p>
                </div>

                <!-- Balance Card -->
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Current Balance</h3>
                    <p class="text-2xl font-bold text-blue-500 mt-2">{{ number_format($balance, 2) }} RWF</p>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
