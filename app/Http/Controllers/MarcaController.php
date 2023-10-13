<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage; // INteragir com o sistema de armazenamento de arquivos
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
        $request->validate($this->marca->rules(), $this->marca->feedback());
        
        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens', 'public');


        //dd($imagem_urn);
        
        $marca = $this->marca->create([
            'nome' => $request->nome,
            'imagem' => $imagem_urn,
        ]);

        
        /* Outra sintaxe para adicionar no BD as informações
        $marca->nome = $request->nome;
        $marca->imagem = $imagem_urn;
        $marca->save();
        */

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
        if($request->method() === 'PATCH'){

            $regrasDinamicas = array();

            // Percorrendo todas as regras definidas no Model

            foreach ($marca->rules() as $input => $regra) {
                //coletar aoenas as regras aplicaveis aos parâmetros parciais da requisição.
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas, $marca->feedback());
        } else {
            $request->validate($marca->rules(), $marca->feedback());
        }

        /* remove o arquivo antigo caso um novo arquivo tenha sido enviado no request */
        if($request->file('imagem')) {
            Storage::disk('public')->delete($marca->imagem);
        }

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens', 'public');

        $marca->update([
            'nome' => $request->nome,
            'imagem' => $imagem_urn
        ]);

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
        
        /* remove o arquivo antigo caso um novo arquivo tenha sido enviado no request */
        Storage::disk('public')->delete($marca->imagem);

        $marca->delete();
        return response()->json(['msg' => 'A marca foi removido com sucesso!'], 200);
    }
}
