<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    /**
     * Esse metodo devolve o estado de determinado pais.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUfsByCountry(Int $countryId) : \Illuminate\Http\JsonResponse
    {
        $ufs = DB::table('ufs')->where('pais', $countryId)->pluck('nome', 'id');
        return response()->json($ufs);
    }

    /**
     * Esse metodo devolve a didade de determinado estado.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCitiesByState(Int $stateId) : \Illuminate\Http\JsonResponse
    {
        $cities = DB::table('cities')->where('uf', $stateId)->pluck('nome', 'id');
        return response()->json($cities);
    }

}
