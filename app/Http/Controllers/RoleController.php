<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{

    public static function middleware() :array{
    return[
        new Middleware('permission:view roles',['only' => 'index']),
        new Middleware('permission:create roles',['only' => 'create']),
        new Middleware('permission:edit roles',['only' => 'edit']),
        new Middleware('permission:delete roles',['only' => 'destroy']),
    ];
    }
    public function index(Request $request)
    {
        if($request->filled('selected')){
            $selectedId = $request->selected;
           Role::whereIn('id',$selectedId)->delete();
           return redirect()->back()->with('delete','Selected Roles Has Been Deleted Sucessfully');
        }
        $roles = Role::paginate(10);
        return view('roles.index',compact('roles'));
    }


    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create',compact('permissions'));
    }


    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'role' => 'required'
        ]);
        $role = Role::create([
            'name' => $request->role,
        ]);
        if($role){
            if($request->filled('permission')){
                foreach($request->permission as $permission){
                    $role->givePermissionTo($permission);
                }
            }
            return redirect()->route('role.index')->with('success','Role created successfully');
        }else{
            return redirect()->route('role.index')->with('error','Failed to create role');
        }
    }

  

   
 
    public function edit(string $id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $hasPermissions = $role->permissions->pluck('name');
        // return $hasPermissions;
        return view('roles.edit',compact('role', 'permissions', 'hasPermissions'));
    }

 
 
    public function update(Request $request, string $id)
    {
        $request->validate([
            'role' => 'required'
        ]);
        $role = Role::find($id);
        if($role){
            $updated = $role->update([
                'name' => $request->role
            ]);

            if($updated){
                $role->syncPermissions($request->permission);
                return redirect()->route('role.index')->with('success','Role updated successfully');
            }else{
                return redirect()->route('role.index', $id)->with('error','Failed to update role');
            }
        }else{
            return redirect()->route('role.index')->with('error','Role Not Found');
        }
    }

  

    public function destroy(string $id)
    {
        $role = Role::find($id);
        if($role){
           $delete =  $role->delete();
           if($delete){
            return redirect()->route('role.index')->with('delete','Role deleted successfully');
           }else{
            return redirect()->route('role.index')->with('error','Failed to delete role');
           }      
        }else{
            return redirect()->route('role.index')->with('error','Role not found');
        }
    }
}
