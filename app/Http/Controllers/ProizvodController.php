<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProizvodResurs;
use App\Models\Proizvod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProizvodController extends BaseController
{
    public function index()
    {
        $proizvodi = Proizvod::all();
        return $this->uspesnoOdgovor(ProizvodResurs::collection($proizvodi), 'Proizvodi iz menija su prikazani.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'naziv' => 'required',
            'cena' => 'required',
            'tipId' => 'required',
            'ukusId' => 'required'
        ]);
        if($validator->fails()){
            return $this->greskaOdgovor($validator->errors());
        }

        $proizvod = Proizvod::create($input);

        return $this->uspesnoOdgovor(new ProizvodResurs($proizvod), 'Proizvod je unet u meni.');
    }


    public function show($id)
    {
        $proizvod = Proizvod::find($id);
        if (is_null($proizvod)) {
            return $this->greskaOdgovor('Proizvod sa zadatim id-em ne postoji.');
        }
        return $this->uspesnoOdgovor(new ProizvodResurs($proizvod), 'Proizvod sa zadatim id-em je prikazan.');
    }


    public function update(Request $request, $id)
    {
        $proizvod = Proizvod::find($id);
        if (is_null($proizvod)) {
            return $this->greskaOdgovor('Proizvod sa zadatim id-em ne postoji.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'naziv' => 'required',
            'cena' => 'required',
            'tipId' => 'required',
            'ukusId' => 'required'
        ]);

        if($validator->fails()){
            return $this->greskaOdgovor($validator->errors());
        }

        $proizvod->naziv = $input['naziv'];
        $proizvod->cena = $input['cena'];
        $proizvod->tipId = $input['tipId'];
        $proizvod->ukusId = $input['ukusId'];
        $proizvod->save();

        return $this->uspesnoOdgovor(new ProizvodResurs($proizvod), 'Proizvod iz menija je izmenjen');
    }

    public function destroy($id)
    {
        $proizvod = Proizvod::find($id);
        if (is_null($proizvod)) {
            return $this->greskaOdgovor('Proizvod sa zadatim id-em ne postoji.');
        }

        $proizvod->delete();
        return $this->uspesnoOdgovor([], 'Proizvod je obrisan iz menija.');
    }
}
