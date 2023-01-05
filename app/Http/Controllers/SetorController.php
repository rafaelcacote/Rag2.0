<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Setor;
use DB;

class SetorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:setor-list|setor-create|setor-edit|setor-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:setor-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:setor-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:setor-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_setor = $request->search_setor;
        $setores = Setor::where(function ($query) use ($search_setor) {
            if ($search_setor) {
                $query->where('descricao', 'LIKE', "%{$search_setor}%");
            }
        })->paginate(10);

        return view('setores.index', compact('setores'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {

        return view('setores.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'descricao' => 'required',
            'sigla' => 'required',

        ]);

        $input = $request->all();

        $setor = Setor::create($input);

        toast('Setor criado com sucesso','success');

        return redirect()->route('setores.index');
    }

    public function edit($id)
    {
        $setor = Setor::find($id);

        return view('setores.edit',compact('setor'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'descricao' => 'required',
            'sigla' => 'required',
        ]);

        $setor = Setor::find($id);
        $setor->descricao = $request->input('descricao');
        $setor->sigla = $request->input('sigla');
        $setor->save();


        toast('Setor atualizado com sucesso','success');

        return redirect()->route('setores.index');
    }

    public function destroy($id)
    {
        DB::table("setores")->where('id',$id)->delete();
        toast('Setor deletado com sucesso','success');
        return redirect()->route('setores.index');

    }
}
