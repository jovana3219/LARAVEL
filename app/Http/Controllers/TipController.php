<?php

namespace App\Http\Controllers;

use App\Http\Resources\TipResurs;
use App\Models\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipController extends BaseController
{
    public function index()
    {
        $tipovi = Tip::all();
        return $this->uspesnoOdgovor(TipResurs::collection($tipovi), 'Vraceni su svi tipovi.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'tip' => 'required',
        ]);
        if($validator->fails()){
            return $this->greskaOdgovor($validator->errors());
        }

        $tip = Tip::create($input);

        return $this->uspesnoOdgovor(new TipResurs($tip), 'Novi tip je kreiran.');
    }


    public function show($id)
    {
        $tip = Tip::find($id);
        if (is_null($tip)) {
            return $this->greskaOdgovor('Tip sa zadatim id-em ne postoji.');
        }
        return $this->uspesnoOdgovor(new TipResurs($tip), 'Tip sa zadatim id-em je vracen.');
    }


    public function update(Request $request, $id)
    {
        $tip = Tip::find($id);
        if (is_null($tip)) {
            return $this->greskaOdgovor('Tip sa zadatim id-em ne postoji.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'tip' => 'required',
        ]);

        if($validator->fails()){
            return $this->greskaOdgovor($validator->errors());
        }

        $tip->tip = $input['tip'];
        $tip->save();

        return $this->uspesnoOdgovor(new TipResurs($tip), 'Tip je azuriraa.');
    }

    public function destroy($id)
    {
        $tip = Tip::find($id);
        if (is_null($tip)) {
            return $this->greskaOdgovor('Tip sa zadatim id-em ne postoji.');
        }

        $tip->delete();
        return $this->uspesnoOdgovor([], 'Tip je obrisan.');
    }
}
