@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold uppercase">Invoices List</h1>
        <a href="{{ route('create') }}"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Add
            Invoice</a>
    </div>
    <div class="relative overflow-x-auto rounded mt-12 drop-shadow-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3">Invoice ID</th>
                    <th class="px-6 py-3">Issue Date</th>
                    <th class="px-6 py-3">Due Date</th>
                    <th class="px-6 py-3">Subject</th>
                    <th class="px-6 py-3">From</th>
                    <th class="px-6 py-3">For</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invoices as $invoice)
                    <tr class="bg-white border-b">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $invoice->id }}
                        </td>
                        <th class="px-6 py-4">{{ $invoice->issue_date }}</th>
                        <td class="px-6 py-4">{{ $invoice->due_date }}</td>
                        <td class="px-6 py-4">{{ $invoice->subject }}</td>
                        <td class="px-6 py-4">{{ $invoice->from }}</td>
                        <td class="px-6 py-4">{{ $invoice->for }}</td>
                        <td class="px-6 py-4">
                            <a href="/detail/{{ $invoice->id }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a>
                            |
                            <a href="/create/{{ $invoice->id }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            |
                            <a href="/delete/{{ $invoice->id }}"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b">
                        <td colspan="7" class="px-6 py-4 font-bold">No Data Yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
