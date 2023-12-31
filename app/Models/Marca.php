<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    //Definimos os atributos que podem ser preenchidos em massa.
    protected $fillable = ['nome', 'imagem'];

    public function rules() {
        return [
            'nome' => 'required|unique:marcas,nome,'.$this->id.'|min:3',
            'imagem' => 'required|file|image|mimes:png' 
        ];
    }

    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'O nome da marca já exite',
            'nome.min' => 'O nome deve ter no mínimo 3 caracteres',
            'imagem.mimes' => 'O arquivo deve ser uma imagem png'
        ];
    }

    public function modelos() {
        //UMA marca POSSUI MUITOS modelos
        return $this->hasMany('App\Models\Modelo'); //Estamos informando que uma marca se relaciona com muitos modelos. 
    }
}
