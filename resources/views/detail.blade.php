@extends('layouts.app')

@section('content')
    <h1 class="text-4xl font-bold uppercase">Invoices</h1>

    <div class="mt-8">
        <table class="text-gray-500 ">
            <tr>
                <td class="py-3 pr-6 border-r-[3px]">Invoice ID</td>
                <td class="pl-2">{{ $invoice->id }}</td>
            </tr>
            <tr>
                <td class="py-3 pr-6 border-r-[3px]">Issue Date</td>
                <td class="pl-2">{{ $invoice->issue_date }}</td>
            </tr>
            <tr>
                <td class="py-3 pr-6 border-r-[3px]">Due Date</td>
                <td class="pl-2">{{ $invoice->due_date }}</td>
            </tr>
            <tr>
                <td class="py-3 pr-6 border-r-[3px]">Subject</td>
                <td class="pl-2">{{ $invoice->subject }}</td>
            </tr>
            <tr>
                <td class="py-3 pr-6 border-r-[3px]">From</td>
                <td class="pl-2">{{ $invoice->from }}</td>
            </tr>
            <tr>
                <td class="py-3 pr-6 border-r-[3px]">For</td>
                <td class="pl-2">{{ $invoice->for }}</td>
            </tr>
        </table>
    </div>

    <div class="relative overflow-x-auto rounded mt-12 drop-shadow-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Item Type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantity
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Unit Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Amount
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invoice->items as $item)
                    <tr class="bg-white border-b">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $item->item_type }}</td>
                        <td class="px-6 py-4">{{ $item->description }}</td>
                        <td class="px-6 py-4">{{ $item->quantity }}</td>
                        <td class="px-6 py-4">${{ $item->unit_price }}</td>
                        <td class="px-6 py-4">${{ $item->amount }}</td>
                    </tr>
                @empty
                    <tr class="bg-white border-b">
                        <td colspan="5" class="px-6 py-4 font-bold">No Data Yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="flex justify-end">
        <table class="text-gray-500 text-end m-3">
            <tr>
                <td class="py-1 pr-9">Subtotal</td>
                <td class="font-bold">${{ $subtotal }}</td>
            </tr>
            <tr>
                <td class="py-1 pr-9">Tax (10%)</td>
                <td class="font-bold">${{ $tax }}</td>
            </tr>
            <tr>
                <td class="py-1 pr-9">Payments</td>
                <td class="font-bold">-${{ $subtotal + $tax }}</td>
            </tr>
            <tr class="text-lg font-bold">
                <td class="pt-4 pr-9">Amount Due</td>
                <td class="pt-4">$0</td>
            </tr>
        </table>
    </div>
@endsection
