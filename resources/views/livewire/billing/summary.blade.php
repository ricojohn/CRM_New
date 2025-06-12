<div>
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
                            <a class="dropdown-item" target="_blank" href="{{ route('billing.summary.edit',  $invoice->invoice_id) }}"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                            <button type="button" class="dropdown-item" wire:click="openDeleteModal('{{ $invoice->invoice_id}}', '{{ $invoice->invoice_no }}')"><i class="bx bx-trash me-1"></i>Delete</button>
                            <a class="dropdown-item" target="_blank" href="{{ route('billing.summary.view',  $invoice->invoice_id) }}"><i class="bx bx-collection me-1"></i>View</a>
                            <a class="dropdown-item" target="_blank" href="{{ route('billing.summary.view',  $invoice->invoice_id) }}"><i class="bx bx-collection me-1"></i>View</a>
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
     <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
                <form wire:submit="deleteInvoice">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Delete?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure that you want to Delete Invoice#  <b>{{ $invoice_no }}</b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="mx-2 btn btn-outline-dark" id="stayLoggedInButton2">Back</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </div>
                </form>
          </div>
      </div>
  </div>
    <!-- End Modal --> 
</div>


<script>
    window.addEventListener('openModal', event => {
        console.log(event);
        const editModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        editModal.show();
    });
    window.addEventListener('closeModal', () => {
        let editModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal')); 
        editModal.hide();
    });

    const toastPlacementExample = document.querySelector('.toast-placement-ex'), toastPlacementBtn = document.querySelector('#showToastPlacement'), toastbody = document.querySelector('.toast-body');
      let selectedType, selectedPlacement, toastPlacement;

      // Dispose toast when open another
      function toastDispose(toast) {
          if (toast && toast._element !== null) {
          if (toastPlacementExample) {
              toastPlacementExample.classList.remove(selectedType);
              DOMTokenList.prototype.remove.apply(toastPlacementExample.classList, selectedPlacement);
          }
          toast.dispose();
          }
      }

      window.addEventListener('query', event => {
          // Get the data from the event (which was passed as an object)
          let status = event.__livewire.params[0].status;  
          let message = event.__livewire.params[0].message; 
          let errorMessage = event.__livewire.params[0].errorMessage; 

          selectedType = status;  // Choose the success type class you want
          selectedPlacement = ['top-0', 'start-50', 'translate-middle-x'];  // You can modify placement as needed

          // Remove previous bg-* status classes
          toastPlacementExample.classList.remove('bg-success', 'bg-danger');

          // Update toast body and classes
          toastbody.textContent = message;
          toastPlacementExample.classList.add(selectedType);
          DOMTokenList.prototype.add.apply(toastPlacementExample.classList, selectedPlacement);

           // Show toast
          toastPlacement = new bootstrap.Toast(toastPlacementExample);
          toastPlacement.show();
          
          console.log(errorMessage);
      });
</script>