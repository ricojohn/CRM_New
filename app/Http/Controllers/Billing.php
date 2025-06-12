<?php

namespace App\Http\Controllers;

use App\Models\q8_invoice;
use App\Models\q8_invoice_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCPDF;

class Billing extends Controller
{
    public function generateInvoice(){
        // Check if the user is already authenticated
        if (Auth::check()) {
            // Redirect them to the home page if logged in
            return view('billing.generateinvoice.index');
        }

        // Show the login form if not logged in
        return redirect('auth.logout');

    }

    public function summary(){
        // Check if the user is already authenticated
        if (Auth::check()) {
            // Redirect them to the home page if logged in
            return view('billing.summary.index');
        }

        // Show the login form if not logged ins
        return redirect('auth.logout');
    }

    public function summaryView($invoice_id){

        // Fetch invoice
        $invoice = q8_invoice::where('invoice_id', $invoice_id)->first();
        if (!$invoice) {
            abort(404, 'Invoice not found');
        }

        $invoice = q8_invoice::where('invoice_id', $invoice_id)->first();
        $items = q8_invoice_details::where('invoice_id', $invoice_id)->get();
        $client = DB::table('q8_clients')->where('company_name', $invoice->client)->first();

        // Fetch client address
        $client = DB::table('q8_clients')->where('company_name', $invoice->client)->first();
        $address = $this->insertNewLine($client->business_address ?? '', 100);
        $notes = $this->insertNewLine($invoice->notes ?? '', 90);


        $tbl = view('billing.summary.view', compact('items', 'invoice'))->render();

        $pdf = new class extends TCPDF {
            public function Header() {
                if ($this->PageNo() === 1) {
                    $img = public_path('assets/img/avatars/itsworkplace.png');
                    list($width, $height) = getimagesize($img);
                    $widthMM = $width * 25.4 / 96;
                    $heightMM = $height * 25.4 / 96;
                    $this->Image($img, $this->getMargins()['left'], 10, $widthMM, $heightMM);
                    $this->Line($this->getMargins()['left'], 10 + $heightMM + 5, $this->getPageWidth() - $this->getMargins()['right'], 10 + $heightMM + 5);
                }
            }
        };

  $pdf->AddPage();
        $cellWidth = 0; // 0 means auto width
        $cellHeight = 10; // Adjust the height as needed

        // Set the alignment of the cell (L: left, C: center, R: right)
        $align = ''; // Center alignment
        $pdf->SetFont('helvetica', '', 12);

        $pdf->SetY(55);$pdf->SetX(22);
        $pdf->writeHTML('<b>BILLING FOR</b>', true, false, true, false, '');
        $pdf->SetY(62);$pdf->SetX(22);
        $pdf->writeHTML('<b>'.$invoice->client.'</b>', true, false, true, false, '');
        $pdf->SetY(69);$pdf->SetX(21);

        $pdf->writeHTMLCell($cellWidth, $cellHeight, '', '', $address, 0, 1, false, true, $align);

        $pdf->SetY(82);$pdf->SetX(22);
        $pdf->writeHTML('<b>Due Date</b>', true, false, true, false, '');
        $pdf->SetY(89);$pdf->SetX(22);
        $pdf->writeHTML('<b>'.$invoice->due_date.'</b>', true, false, true, false, '');

        $pdf->SetY(82);$pdf->SetX(82);
        $pdf->writeHTML('<b>AMOUNT</b>', true, false, true, false, '');
        $pdf->SetY(89);$pdf->SetX(82);
        $pdf->writeHTML('<b>'.$invoice->subtotal.'</b>', true, false, true, false, '');


        $pdf->SetY(82);$pdf->SetX(142);
        $pdf->writeHTML('<b>Invoice #</b>', true, false, true, false, '');
        $pdf->SetY(89);$pdf->SetX(142);
        $pdf->writeHTML('<b>'.$invoice->invoice_no.'</b>', true, false, true, false, '');

        $pdf->SetY(100);$pdf->SetX(82);
        $pdf->writeHTML('<hr>', true, false, true, false, '');

        $pdf->SetY(110);$pdf->SetX(22);
        $pdf->writeHTML($tbl, true, false, false, false, '');


        $pdf->Output('invoice.pdf', 'I'); // 'I' = Inline display
        exit;
        // return response($pdf->Output('', 'S'), 200)
        //     ->header('Content-Type', 'application/pdf');
    }

    private function insertNewLine($input, $every = 90) {
        return wordwrap($input, $every, "<br>", true);
    }

    public function summaryEdit($invoice_id){
        // Check if the user is already authenticated
        if (Auth::check()) {
            return view('billing.summary.edit',[
                'invoice_id' => $invoice_id
            ]);
        }

        // Show the login form if not logged in
        return redirect('auth.logout');
    }

    public function invoiceItems(){
        // Check if the user is already authenticated
        if (Auth::check()) {
            // Redirect them to the home page if logged in
            return view('billing.invoiceitems.index');
        }

        // Show the login form if not logged in
        return redirect('auth.logout');
    }
}
