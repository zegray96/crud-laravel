<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('roles.form', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'name.unique' => 'El valor del campo nombre ya está en uso.',
        ]);
        try {
            DB::beginTransaction();
            Role::create([
                'name'=>$request->name,
            ])->syncPermissions($request->permissions);
            DB::commit();
            return response()->json([
                'title'=>'¡Guardado!',
                'msg' => 'El registro se guardó correctamente',
                'icon' => 'success'
            ], 200);
        } catch (Exception $e) {
            DB::rolback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::get();
        return view('roles.form', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role=Role::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'name.unique' => 'El valor del campo nombre ya está en uso.',
        ]);
        try {
            DB::beginTransaction();
            $role->name = $request->name;
            // Le asigno los permisos
            $role->permissions()->sync($request->permissions);
            $role->save();
            DB::commit();
            return response()->json([
                'title'=>'¡Guardado!',
                'msg' => 'El registro se actualizó correctamente',
                'icon' => 'success'
            ], 200);
        } catch (Exception $e) {
            DB::rolback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role=Role::findOrFail($id);
        $role->delete();
        return response()->json([
            'title'=>'¡Cambios guardados!',
            'msg'=>'El registro se eliminó correctamente',
            'icon'=>'info'
        ]);
    }

    public function list()
    {
        $roles = Role::get();
        return datatables()->of($roles)
        ->addColumn('buttons', 'roles.actionButtons')
        ->rawColumns(['buttons'])
        ->toJson();
    }
}