<?php

namespace App\Http\Controllers;

use App\Http\Resources\UkusResurs;
use App\Models\Ukus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UkusController extends BaseController
{
    public function index()
    {
        $ukusi = Ukus::all();
        return $this->uspesnoOdgovor(UkusResurs::collection($ukusi), 'Vraceni su svi ukusi.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'ukus' => 'required',
        ]);
        if($validator->fails()){
            return $this->greskaOdgovor($validator->errors());
        }

        $ukus = Ukus::create($input);

        return $this->uspesnoOdgovor(new UkusResurs($ukus), 'Novi ukus je kreiran.');
    }


    public function show($id)
    {
        $ukus = Ukus::find($id);
        if (is_null($ukus)) {
            return $this->greskaOdgovor('Ukus sa zadatim id-em ne postoji.');
        }
        return $this->uspesnoOdgovor(new UkusResurs($ukus), 'Ukus sa zadatim id-em je vracen.');
    }


    public function update(Request $request, $id)
    {
        $ukus = Ukus::find($id);
        if (is_null($ukus)) {
            return $this->greskaOdgovor('Ukus sa zadatim id-em ne postoji.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'ukus' => 'required',
        ]);

        if($validator->fails()){
            return $this->greskaOdgovor($validator->errors());
        }

        $ukus->ukus = $input['ukus'];
        $ukus->save();

        return $this->uspesnoOdgovor(new UkusResurs($ukus), 'Ukus je azuriran.');
    }

    public function destroy($id)
    {
        $ukus = Ukus::find($id);
        if (is_null($ukus)) {
            return $this->greskaOdgovor('Ukus sa zadatim id-em ne postoji.');
        }
        $ukus->delete();
        return $this->uspesnoOdgovor([], 'Ukus je obrisan.');
    }
}
