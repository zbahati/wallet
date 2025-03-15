<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Import Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg">
            <form action="{{ route('transactions.import-form') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4 p-6">
                    <label for="excel-file" class="block text-gray-700 dark:text-gray-300">
                        Upload Excel File (XLSX, CSV)
                    </label>
                    <input 
                        type="file" 
                        name="excel-file" 
                        id="excel-file" 
                        class="block w-full p-2 border border-gray-300 dark:border-gray-700 rounded-md"
                        accept=".xlsx, .xls, .csv" 
                        required
                    >
                    @error('excel-file')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg mt-4">
                        Import Transactions
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
