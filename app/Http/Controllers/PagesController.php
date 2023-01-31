<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function index()
    {
        return view('home', [
            'invoices' => Invoice::paginate(15)
        ]);
    }

    public function detail($id)
    {
        if ($id) {
            $invoice = Invoice::find($id);

            $subtotal = 0;
            foreach ($invoice->items as $item) {
                $subtotal += $item->amount;
            }
            $tax = $subtotal * .1;

            return view('detail', [
                'invoice' => $invoice,
                'subtotal' => $subtotal,
                'tax' => $tax
            ]);
        }
    }

    public function create($id = null)
    {
        $invoiceItems = [
            'Design' => false,
            'Development' => false,
            'Meetings' => false
        ];

        if ($id) {
            $invoice = Invoice::find($id);
            if ($invoice) {
                $invoice->issue_date = Carbon::createFromFormat('Y-m-d', $invoice->issue_date)->format('m/d/Y');
                $invoice->due_date = Carbon::createFromFormat('Y-m-d', $invoice->due_date)->format('m/d/Y');
                if (!empty($invoice->items)) {
                    foreach ($invoice->items as $data) {
                        foreach ($invoiceItems as $key => $item) {
                            if ($data->description === strtolower($key)) {
                                $invoiceItems[$key] = true;
                            }
                        }
                    }
                }

                return view('create', [
                    'invoice' => $invoice,
                    'invoiceItems' => $invoiceItems
                ]);
            }
        }

        return view('create', [
            'invoiceItems' => $invoiceItems
        ]);
    }

    public function save(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'issue_date' => 'required',
            'due_date' => 'required',
            'subject' => 'required',
            'from' => 'required',
            'for' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $issueDate = Carbon::createFromFormat('m/d/Y', $requestData['issue_date'])->format('Y-m-d');
        $dueDate = Carbon::createFromFormat('m/d/Y', $requestData['due_date'])->format('Y-m-d');

        $invoice = !empty($requestData['id']) ? Invoice::find($requestData['id']) : new Invoice;
        $invoice->issue_date = $issueDate;
        $invoice->due_date = $dueDate;
        $invoice->subject = $requestData['subject'];
        $invoice->from = $requestData['from'];
        $invoice->for = $requestData['for'];

        if ($invoice->save()) {
            // Karena CRUD untuk invoice items tidak perlu maka saya akan menghardcode data itemsnya
            if (isset($requestData['invoiceItems'])) {
                $invoiceItems = $requestData['invoiceItems'];

                foreach ($invoiceItems as $item) {
                    $invoiceItem = new Item;
                    $invoiceItem->invoice_id = $invoice->id;
                    $invoiceItem->item_type = 'service';
                    $invoiceItem->description = strtolower($item);
                    if ($item === 'Design') {
                        $invoiceItem->quantity = 41;
                        $invoiceItem->unit_price = 230;
                        $invoiceItem->amount = 9430;
                    } else if ($item === 'Development') {
                        $invoiceItem->quantity = 57;
                        $invoiceItem->unit_price = 330;
                        $invoiceItem->amount = 18810;
                    } else {
                        $invoiceItem->quantity = 4.50;
                        $invoiceItem->unit_price = 60;
                        $invoiceItem->amount = 270;
                    }
                    $invoiceItem->save();
                }
            }
            return redirect(route('home'));
        }
    }

    public function delete($id)
    {
        $invoice = Invoice::find($id);
        if ($invoice->delete()) {
            return redirect(route('home'));
        }
        return redirect(route('home'));
    }
}
