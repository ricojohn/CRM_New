<table style="text-align: center;">
    <tr style="background-color:black;">
        <th style="color:white;border: 1px solid black;"><b>Date</b></th>
        <th style="color:white;border: 1px solid black;"><b>Description</b></th>
        <th style="color:white;border: 1px solid black;"><b>Qty</b></th>
        <th style="color:white;border: 1px solid black;"><b>Unit Price</b></th>
        <th style="color:white;border: 1px solid black;"><b>Total</b></th>
    </tr>
    @foreach($items as $item)
        <tr>
            <td style="border: 1px solid black;">{{ $item->item_date }}</td>
            <td style="border: 1px solid black;">{{ $item->item_desc }}</td>
            <td style="border: 1px solid black;">{{ $item->item_qty }}</td>
            <td style="border: 1px solid black;">{{ $item->item_unitprice }}</td>
            <td style="border: 1px solid black;">{{ $item->item_total }}</td>
        </tr>
    @endforeach
    <tr><td colspan="5">&nbsp;</td></tr>
    <tr>
        <td colspan="3"></td>
        <td style="border: 1px solid black;background-color:black;color:white; font-size:14px;"><b>Subtotal</b></td>
        <td style="border: 1px solid black;background-color:black;color:white; font-size:14px;"><b>{{ $invoice->subtotal }}</b></td>
    </tr>
    <tr><td colspan="5" style="text-align:left;" ><b>ACCOUNT INFORMATION</b></td></tr>
    <tr><td colspan="5" style="text-align:left;" >Account Number: 587130009</td></tr>
    <tr><td colspan="5" style="text-align:left;" >Routing Number: 021000021</td></tr>
    <tr><td colspan="5" style="text-align:left;" >Email: accounting@q8marketing.design</td></tr>
    <tr><td colspan="5" style="text-align:left;"><b>Notes:</b><br></td></tr>
    <tr><td colspan="5" style="text-align:left;font-size:8px;">{!! $invoice->notes !!}<br></td></tr>
    <tr><td colspan="5"><img src="{{ public_path('assets/img/avatars/new_invoice_footer.png') }}"></td></tr>
</table>
