<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function __construct(Marca $marca) {
        $this->marca = $marca;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $marcas = $this->marca->all();
        return response()->json($marcas, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {   
        //stateless: propõe que cada requisição seja única

        $request->validate($this->marca->rules(),$this->marca->feedback());

        $marca = $this->marca->create($request->all());
        return response()->json($marca, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        $marca = $this->marca->find($id);
        if($marca === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404); // O laravel converte esse array associativo para json.
        }
        return response()->json($marca, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $marca = $this->marca->find($id);
        
        if($marca === null) {
            return response()->json(['erro' => 'Não pode ser atualizado. O recurso não existe'], 404);
        }
        $marca->update($request->all());
        return response()->json($marca, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marca = $this->marca->find($id);
        
        if($marca === null) {
            return response()->json(['erro' => 'Não pode realiza a exclusão. O recurso não existe'], 404);
        }

        $marca->delete();
        return response()->json(['msg' => 'A marca foi removido com sucesso!'], 200);
    }
}
