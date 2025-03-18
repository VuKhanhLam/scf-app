<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funding;
use App\Models\Invoice;

class FundingController extends Controller
{
    public function fundInvoice(Request $request, Invoice $invoice)
    {
        if ($invoice->funded) {
            return response()->json(['message' => 'Invoice already funded'], 400);
        }

        $funding = Funding::create([
            'invoice_id' => $invoice->id,
            'funded_amount' => $request->input('amount'),
            'funded_date' => now(),
        ]);

        $invoice->update(['funded' => true]);

        return response()->json($funding);
    }
}
