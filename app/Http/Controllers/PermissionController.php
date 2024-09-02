<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view permissions', ['only' => 'index']),
            new Middleware('permission:create permissions', ['only' => 'create']),
            new Middleware('permission:edit permissions', ['only' => 'edit']),
            new Middleware('permission:delete permissions', ['only' => 'destroy']),
        ];
    }

    public function index(Request $request)
    {
        if ($request->filled('selected')) {
            $selectedId = $request->selected;
            Permission::whereIn('id', $selectedId)->delete();
            return redirect()->back()->with('delete', 'Selected permissions deleted successfully');
        }
        $permissions = Permission::Paginate(10);
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'permission' => 'required',
        ]);
        $permission = Permission::create([
            'name' => $request->permission,
        ]);

        if ($permission) {
            return redirect()->route('permission.index')->with('success', 'Permission created successfully.');
        } else {
            return redirect()->route('permission.index')->with('error', 'Failed to create permission.');
        }
    }

    public function edit(string $id)
    {
        $permission = Permission::find($id);

        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'permission' => 'required',
        ]);
        $permission = Permission::find($id);
        if ($permission) {
            $updated = $permission->update([
                'name' => $request->permission,
            ]);
            if ($updated) {
                return redirect()->route('permission.index')->with('success', 'Permission Has Been Updated Successfully');
            } else {
                return redirect()->route('permission.index')->with('error', 'Failed To Update Permission');
            }
        }
    }

    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        if ($permission) {
            $delete = $permission->delete();
            if ($delete) {
                return redirect()->route('permission.index')->with('delete', 'permission Has Been Deleted Successfully');
            } else {
                return redirect()->route('permission.index')->with('error', 'Failed To Delete Permission');
            }
        } else {
            return redirect()->route('permission.index')->with('error', 'Permission Not Found');
        }
    }
}
