<?php

namespace App\Livewire\Roles;


use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Roles extends Component
{
    public $role, $roleId, $deleteId;
    
    public $permission = [];
    public $search = '';

    protected  function rules()
    {
        return [
            'role' => 'required|unique:roles,name,'. $this->roleId,
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $roles = Role::all();

        $permissions = Permission::all();
        return view('livewire.roles.roles',[
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function createRoleModal(){
        $this->reset();
        $this->resetValidation();
        // Trigger modal
        $this->dispatch('openRolesModal');
    }

    public function editRoleModal($id){
        $this->reset();
        $this->resetValidation();
        $role = Role::with('permissions')->findOrFail($id);
        $this->role = $role->name;
        $this->roleId = $role->id;
        $this->permission = $role->permissions->pluck('name')->toArray();
        // Trigger modal
        $this->dispatch('openRolesModal');
    }

    public function deleteRoleModal($id){
        $role = Role::find($id);
        $this->deleteId = $role->id;
        $this->role = $role->name;
        // Trigger modal
        $this->dispatch('openDeleteRolesModal');
    }

    public function submit(){
        $this->validate();
        try {
            //code...
            $role = Role::updateOrCreate(
                ['id' => $this->roleId], // If null, it creates a new one
                ['name' => $this->role]
            );

            $this->dispatch('query', ['status' => 'bg-success', 'message' => $this->roleId ? $this->role.' Role Updated' : $this->role.' Role Created']);


            // Trigger modal close
            $role->syncPermissions($this->permission);
            // Message
            $this->dispatch('closeRolesModal');
        } catch (\Throwable $th) {
            //throw $th;
            // Message
            $this->dispatch('query', ['status' => 'bg-danger', 'message' => 'Failed', 'errorMessage' => $th->getMessage()]);
        }
    }

    public function delete()
    {
        try {
            //code...
            $role = Role::find($this->deleteId);
            $role->delete();
            $this->dispatch('query', ['status' => 'bg-success', 'message' => $this->role.' Role Deleted']);

            $this->deleteId = null;
            // Trigger modal close
            $role->syncPermissions($this->permission);
            // Message
            $this->dispatch('closeDeleteRolesModal');
        } catch (\Throwable $th) {
            //throw $th;
            // Message
            $this->dispatch('query', ['status' => 'bg-danger', 'message' => 'Failed', 'errorMessage' => $th->getMessage()]);
        }
    }
}
