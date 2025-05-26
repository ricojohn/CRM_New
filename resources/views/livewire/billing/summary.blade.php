<div class="card">
    <h5 class="card-header">Invoice Summary</h5>
    <div class="justify-between mx-3 mb-3 row align-items-center">
        <div class="mb-2 col-md-6 col-12 mb-lg-0">
        </div>
        <div class="col-lg-2 col-md-6 col-12">
            <input
                type="text"
                class=" form-control"
                placeholder="Search items..."
                wire:model.live="search"
            />
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <!-- Search Bar -->
        
        <table class="table mb-5 table-hover">
            <thead>
            <tr>
                <th>Invoice Date</th>
                <th>Client</th>
                <th>Project</th>
                <th>Invoice#</th>
                <th>Due Date</th>
                <th>Subtotal</th>
                <th>Sales Commission</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($invoices as $invoice)
                <tr>
                <td>{{ $invoice->invoice_date}}</td>
                <td>{{ $invoice->client }}</td>
                <td>{{ $invoice->project }}</td>
                <td>{{ $invoice->invoice_no }}</td>
                <td>{{ $invoice->due_date }}</td>
                <td>{{ $invoice->subtotal }}</td>
                <td>{{ $invoice->sales_representative }}</td>
                <td>
                    <span class="badge bg-warning">
                       {{ $invoice->status }}
                    </span>
                </td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="p-0 btn dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu" style="">
                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                        </div>
                    </div>
                </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-5 d-flex justify-content-center">
            {{ $invoices->links() }}
        </div>
    </div>
</div>