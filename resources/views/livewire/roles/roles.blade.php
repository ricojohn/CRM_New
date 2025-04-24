<div class="card">
    <h5 class="card-header">Roles table</h5>
    <div class="justify-between mx-3 mb-3 row align-items-center">
        <div class="mb-2 col-md-6 col-12 mb-lg-0">
            <button type="button" class="btn btn-primary" wire:click="createRoleModal()">
                <span class="tf-icons bx bxs-user-plus bx-18px me-2"></span>
                Add Role
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
                <th>Roles</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($roles as $role)
                <tr>
                <td>{{ $role->name}}</td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="p-0 btn dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu" style="">
                          <a class="dropdown-item" href="javascript:void(0);" wire:click="editRoleModal({{ $role->id }})"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                          <a class="dropdown-item" href="javascript:void(0);" wire:click="deleteRoleModal({{ $role->id }})"><i class="bx bx-trash me-1"></i> Delete</a>
                        </div>
                    </div>
                </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{-- <div class="mt-5 d-flex justify-content-center">
            {{ $roles->links() }}
        </div> --}}
    </div>
    
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="rolesModal" data-bs-backdrop="static" tabindex="-1" >
        <div class="modal-dialog">
          <form class="modal-content" autocomplete="off"  wire:submit="submit">
            <div class="modal-header">
              <h5 class="modal-title" id="employeeModalModalTitle">{{ $roleId ? 'Edit Role' : 'Create Role' }}</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="mb-6 col-12">
                  <label for="role" class="form-label">Role Name</label>
                  <input
                    type="text"
                    id="role"
                    class="form-control"
                    placeholder="Role Name" 
                    wire:model='role'
                    />
                    @error('role')
                        <div class="error">
                        {{ $message }} 
                        </div>
                    @enderror
                </div>
                <div class="mb-6 col-12">
                    <small class="text-light fw-medium">Permissions</small>
                    @foreach ($permissions as $permission)
                        <div class="mt-3 form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $permission->name }}" wire:model='permission' id="permission">
                            <label class="form-check-label" for="permission"> {{ $permission->name }} </label>
                        </div>
                    @endforeach
                    @error('permission')
                        <div class="error">
                        {{ $message }} 
                        </div>
                    @enderror
                </div>
              </div>
            </div>
           
            <div class="modal-footer">
              <button type="button" class="me-3 btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
    </div>
    {{-- Delete --}}
    <div  wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModal">Delete Role</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this role? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="me-3 btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                          </button>
                          <button type="button" class="btn btn-danger" wire:click="delete">Delete</button>
                    </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('openRolesModal', event => {
        const editModal = new bootstrap.Modal(document.getElementById('rolesModal'));
        editModal.show();
    });

    window.addEventListener('closeRolesModal', () => {
        let editModal = bootstrap.Modal.getInstance(document.getElementById('rolesModal')); 
        editModal.hide();
    });

    window.addEventListener('openDeleteRolesModal', event => {
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    });

    window.addEventListener('closeDeleteRolesModal', () => {
        let deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal')); 
        deleteModal.hide();
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

        toastbody.textContent = message;
        toastPlacementExample.classList.add(selectedType);
        DOMTokenList.prototype.add.apply(toastPlacementExample.classList, selectedPlacement);
        toastPlacement = new bootstrap.Toast(toastPlacementExample);
        toastPlacement.show();
        console.log(errorMessage);
    });
</script>