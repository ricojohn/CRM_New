<div class="card">
  <h5 class="card-header">Employees table</h5>
  <div class="justify-between mx-3 mb-3 row align-items-center">
      <div class="mb-2 col-md-6 col-12 mb-lg-0">
          <button type="button" class="btn btn-primary" wire:click="addClient()">
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
              <th>Sales Representative</th>
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
  <div class="modal fade" id="clientModal" data-bs-backdrop="static" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <form class="modal-content" autocomplete="off" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="clientModalModalTitle">Add New Client
            </h5>
            <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
            </button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="mb-6 col-12">
                      <label for="client_id" class="form-label">Employee ID
                      </label>
                      <input
                              type="text"
                              id="client_id"
                              class="form-control"
                              placeholder="Enter Name" 
                              readonly
                              value="{{ 'Q8-'.date('mdyhis').rand(1,10) }}"/>
                  </div>
              </div>
          
              <div class="mb-2 row g-6">
                <div class="col-lg-6">
                  <label for="first_name" class="form-label">Company Name
                  </label>
                  <input
                         type="text"
                         id="first_name"
                         class="form-control"
                         placeholder="First Name" />
                </div>
                <div class="col-lg-6">
                  <label for="last_name" class="form-label">Business Address
                  </label>
                  <input
                         type="text"
                         id="last_name"
                         class="form-control"
                         placeholder="Last Name" />
                </div>
              </div>
              <div class="mb-2 row g-6">
                <div class="col-lg-6">
                  <label for="email" class="form-label">Email
                  </label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <i class='bx bxs-id-card'>
                      </i>
                    </span>
                    <input type="email" class="form-control" placeholder="xxx@xxx.com" id="email">
                  </div>
                </div>
                <div class="col-lg-6">
                  <label for="phone" class="form-label">Phone Number
                  </label>
                  <div class="input-group">
                    <span class="input-group-text">
                      <i class='bx bxs-phone'>
                      </i>
                    </span>
                    <input type="text" class="form-control" placeholder="Phone Number" id="phone">
                  </div>
                </div>
              </div>
              <div class="mb-2 row g-6">
                <div class="col-lg-6">
                  <label for="website" class="form-label">Website
                  </label>
                  <select
                          id="website"
                          class="form-control">
                    <option>
                    </option>
                  </select>
                </div>
                <div class="col-lg-6 ">
                  <label for="position" class="form-label">Facebook Link
                  </label>
                  <input
                         type="text"
                         id="position"
                         class="form-control"
                         placeholder="Position" />
                </div>
              </div>
              <div class="mb-2 row g-6">
                <div class="col-lg-6">
                  <label for="website" class="form-label">Instagram Link
                  </label>
                  <select
                          id="website"
                          class="form-control">
                    <option>
                    </option>
                  </select>
                </div>
                <div class="col-lg-6 ">
                  <label for="position" class="form-label">LinkedIn Link
                  </label>
                  <input
                         type="text"
                         id="position"
                         class="form-control"
                         placeholder="Position" />
                </div>
              </div>
              <div class="mb-2 row g-6">
                <div class="col-lg-6">
                  <label for="photo" class="form-label">Photo
                  </label>
                  <div class="input-group">
                    <label class="input-group-text" for="photo">Upload
                    </label>
                    <input type="file" class="form-control" id="photo">
                  </div>
                </div>
                <div class="col-lg-6 form-password-toggle">
                  <label for="password" class="form-label">Password
                  </label>
                  <div class="input-group input-group-merge">
                    <input type="text" class="form-control" id="basic-default-password32" placeholder="············" aria-describedby="basic-default-password">
                    <span class="cursor-pointer input-group-text" id="basic-default-password">
                      <i class="bx bx-show">
                      </i>
                    </span>
                  </div>
                </div>
              </div>
              <div class="mb-2 row g-6">
                  <div class="col-lg-6">
                    <label for="salesRep" class="form-label">Sales Representative</label>
                    <select
                      id="salesRep"
                      class="form-control">
                      <option></option>
                    </select>
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

{{-- <script>
  window.addEventListener('openClientModal', event => {
      const editModal = new bootstrap.Modal(document.getElementById('clientModal'));
      editModal.show();
  });
</script> --}}