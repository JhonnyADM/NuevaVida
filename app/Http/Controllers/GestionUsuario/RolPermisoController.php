<?php

namespace App\Http\Controllers\GestionUsuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolPermisoController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Muestra la vista para editar los permisos de un rol
     */
    public function editPermissions(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('roles.edit-permissions', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Actualiza los permisos de un rol
     */
    public function updatePermissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Convertimos los IDs en nombres (Spatie requiere nombres para syncPermissions)
        $permissionNames = Permission::whereIn('id', $request->permissions ?? [])->pluck('name');

        $role->syncPermissions($permissionNames);

        return redirect()->route('roles.index')->with('success', 'Permisos actualizados correctamente.');
    }
}
