<div class="card">
  <h5 class="card-header">Employees table</h5>
  <div class="justify-between mx-3 mb-3 row align-items-center">
      <div class="mb-2 col-md-6 col-12 mb-lg-0">
          <button type="button" class="btn btn-primary" wire:click="createQuote()">
              <span class="tf-icons bx bxs-user-plus bx-18px me-2"></span>
              Create Quoatation
          </button>
          <!-- Items Per Page Dropdown -->
          {{-- <select class="form-select" wire:model.live.debounce.300ms="perPage">
              <option value="10">10</option>
              <option value="15">15</option>
              <option value="20">20</option>
          </select> --}}
      </div>
      <div class="col-lg-4 col-md-6 col-12">
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
              <th>Company</th>
              <th>Email</th>
              <th>Setup Fee</th>
              <th>Monthly Fee</th>
              <th>Due Date</th>
              <th>Status</th>
              <th>Email Status</th>
              <th>Action</th>
          </tr>
          </thead>
          <tbody class="table-border-bottom-0">
          {{-- @foreach ($clients as $client)
              <tr>
              <td>{{ $client->company_name}}</td>
              <td>{{ $client->email_address }}</td>
              <td>{{ $client->sales_representative }}</td>
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
          @endforeach --}}
          </tbody>
      </table>
      <div class="mt-5 d-flex justify-content-center">
          {{-- {{ $clients->links() }} --}}
      </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="quoteModal" data-bs-backdrop="static" tabindex="-1">
      <div class="modal-dialog modal-xl">
        <form class="modal-content" autocomplete="off" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="quoteModalModalTitle">New Quoatation
            </h5>
            <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
            </button>
          </div>
          <div class="modal-body">
              <div class="mb-2 row g-6">
                <div class="col-lg-6">
                  <label for="first_name" class="form-label">Company Name
                  </label>
                  <select name="" id="" class="form-select">

                  </select>
                </div>
                <div class="col-lg-6">
                  <label for="last_name" class="form-label">Setup Fee
                  </label>
                  <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control" placeholder="Setup Fee" aria-label="Amount (to the nearest dollar)">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>
              </div>
              <div class="mb-2 row g-6">
                <div class="col-lg-6">
                  <label for="" class="form-label">Monthly Fee
                  </label>
                  <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control" placeholder="Monthly Fee" aria-label="Amount (to the nearest dollar)">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>
                <div class="col-lg-6">
                  <label for="phone" class="form-label">Due Date
                  </label>
                  <input type="text" id="datepicker" class="form-control" >
                </div>
              </div>
              <div class="mb-2 row g-6">
                <div class="col-lg-6">
                  <label for="website" class="form-label">One Time Fee
                  </label>
                  <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control" placeholder="One Time Fee" aria-label="Amount (to the nearest dollar)">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>
                <div class="col-lg-6 ">
                  <label for="position" class="form-label">Payment Link
                  </label>
                  <div class="input-group">
                    <span class="input-group-text"><i class='bx bx-link-alt'></i></span>
                    <input type="text" class="form-control" placeholder="Payment Link" id="text">
                  </div>
                </div>
              </div>
              <div class="mb-2 row g-6">
                <div class="col-lg-12">
                  <label for="website" class="form-label">Introduction
                  </label>
                  <textarea id="introduction" ></textarea>
                </div>
              </div>
              <div>
                <div class="col-lg-12">
                  <label for="position" class="form-label">Content
                  </label>
                  <textarea id="content" ></textarea>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="me-3 btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary">Save
            </button>
          </div>
        </form>
      </div>
     </div>
</div>

<script type="text/javascript">
window.addEventListener('openQuoteModal', event => {
    const editModal = new bootstrap.Modal(document.getElementById('quoteModal'));
    editModal.show();

    // Initialize CKEditor for both fields
    ckeditorINIT('introduction');
    ckeditorINIT('content');

    // Ensure Flatpickr initializes correctly
    setTimeout(() => {
        if (typeof flatpickr !== "undefined") { // Check if Flatpickr is loaded
            console.log("Initializing Flatpickr...");
            flatpickr("#datepicker", {
                dateFormat: "m-d-Y",
                static: true
            });
        } else {
            console.error("Flatpickr is not loaded!");
        }
    }, 300);
});

// Function for CKEditor initialization
function ckeditorINIT(id) {
    // Check if CKEditor instance exists and destroy it
    if (CKEDITOR.instances[id]) {
        CKEDITOR.instances[id].destroy(true);
    }

    // Initialize CKEditor
    CKEDITOR.replace(id, {
        extraPlugins: 'editorplaceholder,font',
        editorplaceholder: $("#" + id).attr("placeholder"),
        height: 192,
        toolbar: [
            { name: 'document', items: ['Source', '-', 'NewPage', 'Preview'] },
            { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'BulletedList', 'NumberedList'] },
            { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] },
            { name: 'tools', items: ['Maximize'] },
        ],
    });
}

</script>
