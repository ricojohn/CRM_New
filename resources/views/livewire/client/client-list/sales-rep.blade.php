<div class="card">
    <h5 class="card-header">Department table</h5>
    <div class="justify-between mx-3 mb-3 row align-items-center">
        <div class="mb-2 col-md-6 col-12 mb-lg-0">
            <button type="button" class="btn btn-primary" wire:click="addSales()">
                <span class="tf-icons bx bxs-user-plus bx-18px me-2"></span>
                Add Sales
            </button>
            <!-- Items Per Page Dropdown -->
            {{-- <select class="form-select" wire:model.live.debounce.300ms="perPage">
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
            </select> --}}
        </div>
        <div class="col-md-6 col-12">
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
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($sales as $sale)
                <tr>
                <td>{{ $sale->sales_representative}}</td>
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
            {{ $sales->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="salesModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
          <form class="modal-content" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="salesModalModalTitle">Add New Sales Representative</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="mb-6 col-12">
                  <label for="department" class="form-label">Name</label>
                  <input
                    type="text"
                    id="department"
                    class="form-control"
                    placeholder="Full Name" 
                    />
                </div>
              </div>
            </div>
           
            <div class="modal-footer">
              <button type="button" class="me-3 btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="button" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
</div>

<script>
    window.addEventListener('openSalesModal', event => {
        const editModal = new bootstrap.Modal(document.getElementById('salesModal'));
        editModal.show();
    });
</script>