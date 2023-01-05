<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Setor;
use App\Http\Requests\User\UpdatePasswordUserRequest;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-edit-password', ['only' => ['edit','update','editPassword']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $setores = Setor::pluck('descricao', 'id')->all();

        $search_usuario = $request->search_usuario;
        $data = User::where(function ($query) use ($search_usuario) {
            if ($search_usuario) {
                $query->where('name', 'LIKE', "%{$search_usuario}%");
            }
        })->paginate(5);
        return view('users.index', compact('data', 'setores'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        $setores = Setor::pluck('descricao', 'id')->all();
        return view('users.create', compact('roles', 'setores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        $setores = $request->input('setor') ? $request->input('setor') : [];
        $user->setores()->sync($setores);

        toast('Usuário criado com sucesso','success');

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $setores = Setor::pluck('name', 'id')->all();
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all()->pluck('name', 'id');
        $setores = Setor::all()->pluck('descricao', 'id');

        $user->load('roles');
        $user->load('setores');

        return view('users.edit', compact('roles', 'user', 'setores'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user['active'] = (!isset($request['status']))? 0 : 1;
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        $user->setores()->sync($request->input('setores'));

        toast('Usuário Editado com sucesso','success');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function editPassword($id)
    {
        $user = User::find($id);

        if (!$user) {
            $this->flashMessage('warning', 'Usuário não encontrado!', 'danger');
            return redirect()->route('user');
        }

        return view('users.edit_password', compact('user'));
    }

    public function updatePassword(UpdatePasswordUserRequest $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            $this->flashMessage('warning', 'Usuário não encontrado!', 'danger');
            return redirect()->route('user');
        }

        $request->merge(['password' => bcrypt($request->get('password'))]);

        $user->update($request->all());

        toast('Senha do usuário atualizada com sucesso!','success');

        return redirect()->route('user');
    }
}
