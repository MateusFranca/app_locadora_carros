<?php

namespace App\Http\Controllers;

use App\Models\Marca; //Importar o Model "Marca" para podermos usar ele aqui.
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Retorna todos os registros da Marca
    public function index()
    {
        $marcas = Marca::all();
        return $marcas;
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
        //Recuperamos o Model "Marca" e estamos criando um novo registo. Por causa do all() a inserção é em massa o que faz com que precisamos no Model "Marca" ele possa receber os dados dessa forma. 
        $marca = Marca::create($request->all());
        //O dd e para mandar a requisição e all() para isolar quando vamos ver na postman
        //dd($request->all());
        return $marca;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    
     // Retorna apena um registro da Marca, temos que passar por paramentro a identificação desse respetivo registro. 
    public function show(Marca $marca)
    {
        return $marca;
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
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */

     //Método update serve para atualizar os dados
    public function update(Request $request, Marca $marca)
    {
        /*
        print_r($request->all()); // os dados atualizados
        echo "<hr>";
        print_r($marca->getAttributes()); // os dados antigos
        */
        $marca->update($request->all());
        return $marca; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marca $marca)
    {
        //print_r($marca->getAttributes());
        $marca->delete();
        return ['msg' => 'A marca foi removido com sucesso!'];
    }
}
