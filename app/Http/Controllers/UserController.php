<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        // Solo podran acceder al metodo index y list los que tengan el permiso users.list
        $this->middleware('can:users.list')->only('index', 'list');
        $this->middleware('can:users.create')->only('create', 'store');
        $this->middleware('can:users.edit')->only('edit', 'update');
        $this->middleware('can:users.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::get();
        return view('users.form', compact('roles'));
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
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'role_id' => 'required'
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.unique'  => 'Este email, ya está asociado a un usuario',
            'password.required' => 'El campo password es obligatorio',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'role_id.required' => 'El campo rol es obligatorio'
        ]);
        try {
            // Buscamos el rol
            $rol=Role::find($request->role_id);

            DB::beginTransaction();
            User::create([
                'name'=>$request->name,
                'password'=>Hash::make($request->password),
                'email'=>$request->email
            ])->assignRole($rol);
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
        $user=User::find($id);
        $roles=Role::get();
        return view('users.form', compact('user', 'roles'));
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
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
            'password' => 'confirmed'
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.unique'  => 'Este email, ya está asociado a un usuario',
            'password.confirmed' => 'Las contraseñas no coinciden'
        ]);
        try {
            // Buscamos el rol
            $rol=Role::find($request->role_id);
            
            if (isset($request->password)) {
                $user->password = Hash::make($request->password);
            }
            DB::beginTransaction();
            $user->name= $request->name;
            $user->email= $request->email;
            // Le asigno el rol
            $user->roles()->sync($rol);
            $user->save();
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
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'title'=>'¡Cambios guardados!',
            'msg'=>'El registro se eliminó correctamente',
            'icon'=>'info'
        ]);
    }

    public function list()
    {
        $users = User::get();
        return datatables()->of($users)
        ->addColumn('buttons', 'users.actionButtons')
        ->addColumn('roles', function ($users) {
            return $users->roles->first()->name;
        })
        ->rawColumns(['buttons','roles'])
        ->toJson();
    }
}