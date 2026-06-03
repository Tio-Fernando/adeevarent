<?php

namespace App\Http\Controllers;

use App\Models\Sewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function show($id)
    {
        $sewa = Sewa::with([
            'pelanggan',
            'kendaraan',
            'payments' => function($q) {
                $q->where('transaction_status', 'settlement')->orderBy('created_at');
            }
        ])->findOrFail($id);

        $invoice = $this->generateInvoice($sewa);

        $dpPayment    = $sewa->payments->where('status_pembayaran', 'dp')->first();
        $lunasPayment = $sewa->payments->where('status_pembayaran', 'lunas')->first();
        $langsungLunas = !$dpPayment && $lunasPayment ? true : false;

        $isAdmin = Auth::check() && in_array(Auth::user()->level, ['SuperAdmin', 'Administrator']);

        if ($isAdmin) {
            return view('admin.invoice.show', compact('sewa', 'invoice', 'dpPayment', 'lunasPayment', 'langsungLunas'));
        }

        return view('invoice.show', compact('sewa', 'invoice', 'dpPayment', 'lunasPayment', 'langsungLunas', 'isAdmin'));
    }

    public function download($id)
    {
        $sewa = Sewa::with([
            'pelanggan',
            'kendaraan',
            'payments' => function($q) {
                $q->where('transaction_status', 'settlement')->orderBy('created_at');
            }
        ])->findOrFail($id);

        $invoice = $this->generateInvoice($sewa); 

        $dpPayment    = $sewa->payments->where('status_pembayaran', 'dp')->first();
        $lunasPayment = $sewa->payments->where('status_pembayaran', 'lunas')->first();
        $langsungLunas = !$dpPayment && $lunasPayment ? true : false;

        $isAdmin = Auth::check() && in_array(Auth::user()->level, ['SuperAdmin', 'Administrator']);

        // Tentukan view berdasarkan role
        $view = $isAdmin ? 'admin.invoice.pdf' : 'invoice.pdf';

        $pdf = Pdf::loadView($view, compact('sewa', 'invoice', 'dpPayment', 'lunasPayment', 'langsungLunas'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Invoice-' . $invoice . '.pdf');
    }

    protected function generateInvoice($sewa)
    {
        return \Carbon\Carbon::parse($sewa->created_at)->format('Ymd') . str_pad($sewa->id_tr_sewa, 3, '0', STR_PAD_LEFT);
    }
}