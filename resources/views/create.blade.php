@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold uppercase">Invoice Form</h1>

    <form method="POST" action="{{ route('save') }}" class="mt-4 w-2/4">
        @csrf
        <input type="hidden" name="id" value="{{ isset($invoice) ? $invoice->id : '' }}" />
        <div class="mb-6 flex gap-3">
            <div>
                <label for="issue_date" class="block mb-2 text-sm font-medium text-gray-900">Issue Date</label>
                <div class="relative max-w-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input datepicker type="text" name="issue_date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="Select date" value="{{ isset($invoice) ? $invoice->issue_date : '' }}">
                </div>
                @error('issue_date')
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                        role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <label for="due_date" class="block mb-2 text-sm font-medium text-gray-900">Due Date</label>
                <div class="relative max-w-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input datepicker type="text" name="due_date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="Select date" value="{{ isset($invoice) ? $invoice->due_date : '' }}">
                </div>
                @error('due_date')
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                        role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-6">
            <label for="subject" class="block mb-2 text-sm font-medium text-gray-900">Subject</label>
            <input type="text" name="subject"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                required value="{{ isset($invoice) ? $invoice->subject : '' }}">
            @error('subject')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-6">
            <label for="from" class="block mb-2 text-sm font-medium text-gray-900">From</label>
            <input type="text" name="from"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                required value="{{ isset($invoice) ? $invoice->from : '' }}">
            @error('from')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-6">
            <label for="for" class="block mb-2 text-sm font-medium text-gray-900">For</label>
            <input type="text" name="for"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                required value="{{ isset($invoice) ? $invoice->for : '' }}">
            @error('for')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-6">
            <label for="invoiceItems[]" class="block mb-2 text-sm font-medium text-gray-900">Invoice Items</label>
            <select name="invoiceItems[]" class="chosen-select" data-placeholder="Add invoice items..." multiple>
                @foreach ($invoiceItems as $key => $item)
                    <option value="{{ $key }}" {{ isset($invoice) ? ($item === true ? 'selected' : '') : '' }}>
                        {{ ucfirst($key) }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/datepicker.min.js"></script>
@endsection
@section('js')
    <script src="{{ asset('chosen/chosen.jquery.min.js') }}"></script>
    <script>
        $(".chosen-select").chosen({
            width: "100%"
        });
    </script>
@endsection
