<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return response()->json([
            'data' => $invoices
        ]);
    }

    public function show($id)
    {
        $invoice = Invoice::find($id);
        $invoice->items; // Untuk memastikan bahwa items invoice terterah di variable tersebut

        return response()->json([
            'data' => $invoice
        ]);
    }
}
