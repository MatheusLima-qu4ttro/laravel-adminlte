<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getCities(string $term = null)
    {
        return DB::table("ufs")
            ->select("id", "nome")
            ->when(isset($term), function($query) use ($term) {
                $query->where('nome', 'like', '%'.$term.'%');
            })
            ->get()
            ->toArray();
    }

    public function getCity(string $term = null, int $uf_id = null)
    {
        return DB::table("cities")
            ->select("id", "nome")
            ->when(isset($term), function($query) use ($term) {
                $query->where('nome', 'like', '%'.$term.'%');
            })
            ->when(isset($uf_id), function($query) use ($uf_id) {
                $query->where('uf', $uf_id);
            })
            ->get()
            ->toArray();
    }
}
