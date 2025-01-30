<div class="card">
    <h5 class="card-header">Employees table</h5>
    <div class="justify-between mx-3 mb-3 row align-items-center">
        <div class="mb-2 col-md-6 col-12 mb-lg-0">
            <button type="button" class="btn btn-primary" wire:click="addEmployee()">
                <span class="tf-icons bx bxs-user-plus bx-18px me-2"></span>
                Add Employee
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
                <th>Name</th>
                <th>Position</th>
                <th>Department</th>
                <th>Start Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($employees as $employee)
                <tr>
                <td>{{ $employee->first_name}}</td>
                <td>{{ $employee->position }}</td>
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->employment_date }}</td>
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
        {{-- <div class="mt-3 d-flex justify-content-between align-items-center">
            <button
                class="btn btn-primary"
                wire:click="previousPage"
                @if ($employee->onFirstPage()) disabled @endif
            >
                Previous
            </button>
            <span>Page {{ $employee->currentPage() }} of {{ $employee->lastPage() }}</span>
            <button
                class="btn btn-primary"
                wire:click="nextPage"
                @if (!$employee->hasMorePages()) disabled @endif
            >
                Next
            </button>
        </div> --}}
        {{-- <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
              <li class="page-item prev">
                <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-left bx-sm"></i></a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:void(0);">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:void(0);">2</a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="javascript:void(0);">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:void(0);">4</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:void(0);">5</a>
              </li>
              <li class="page-item next">
                <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-right bx-sm"></i></a>
              </li>
            </ul>
          </nav> --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $employees->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="employeeModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <form class="modal-content" autocomplete="off" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="employeeModalModalTitle">Add New Employee</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="mb-6 col-12">
                  <label for="employee_id" class="form-label">Employee ID</label>
                  <input
                    type="text"
                    id="employee_id"
                    class="form-control"
                    placeholder="Enter Name" 
                    readonly
                    value="{{ 'Q8-'.date('mdyhis').rand(1,10) }}"/>
                </div>
              </div>
              <div class="mb-2 row g-6">
                <div class="col-lg-6">
                  <label for="first_name" class="form-label">First Name</label>
                  <input
                    type="text"
                    id="first_name"
                    class="form-control"
                    placeholder="First Name" />
                </div>
                <div class="col-lg-6">
                  <label for="last_name" class="form-label">Last Name</label>
                  <input
                    type="text"
                    id="last_name"
                    class="form-control"
                    placeholder="Last Name" />
                </div>
              </div>
              <div class="mb-2 row g-6">
                <div class="col-lg-6">
                  <label for="first_name" class="form-label">Department</label>
                  <select
                    id="department"
                    class="form-control">
                    <option></option>
                  </select>
                </div>
                <div class="col-lg-6 ">
                  <label for="position" class="form-label">Position</label>
                  <input
                    type="text"
                    id="position"
                    class="form-control"
                    placeholder="Position" />
                </div>
              </div>
              <div class="mb-2 row g-6">
                <div class="col-lg-6">
                  <label for="phone" class="form-label">Phone Number</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class='bx bxs-phone'></i></span>
                    <input type="text" class="form-control" placeholder="Phone Number" id="phone">
                  </div>
                </div>
                <div class="col-lg-6">
                  <label for="address" class="form-label">Address</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class='bx bxs-id-card'></i></span>
                    <input type="text" class="form-control" placeholder="Address" id="address">
                  </div>
                </div>
              </div>
              <div class="mb-2 row g-6">
                <div class="col-lg-6">
                  <label for="dob" class="form-label">DOB</label>
                  <input
                    type="text"
                    id="dob"
                    class="form-control"
                    placeholder="Date of Birth" />
                </div>
                <div class="col-lg-6">
                  <label for="employment_date" class="form-label">Employment Date</label>
                  <input
                    type="text"
                    id="employment_date"
                    class="form-control"
                    placeholder="Employment Date"/>
                </div>
              </div>
              <div class="mb-2 row g-6">
                <div class="col-lg-6">
                  <label for="access" class="form-label">Access</label>
                  <select
                    id="access"
                    class="form-control">
                    <option>--</option>
                  </select>
                </div>
                <div class="col-lg-6">
                  <label for="status" class="form-label">Status</label>
                  <input
                    type="text"
                    id="status"
                    class="form-control"
                    value="Active" readonly/>
                </div>
              </div>
              <div class="mb-2 row g-6">
                <div class="col-lg-6">
                  <label for="photo" class="form-label">Photo</label>
                  <div class="input-group">
                    <label class="input-group-text" for="photo">Upload</label>
                    <input type="file" class="form-control" id="photo">
                  </div>
                </div>
                <div class="col-lg-6">
                  <label for="salary" class="form-label">Salary</label>
                  <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control" placeholder="Salary" aria-label="Amount (to the nearest dollar)">
                    <span class="input-group-text">.00</span>
                  </div>
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
    window.addEventListener('openEmployeeModal', event => {
        const editModal = new bootstrap.Modal(document.getElementById('employeeModal'));
        editModal.show();
    });
</script>