<?php

namespace App\Http\Controllers\CreateCompany;

use App\Http\Controllers\Controller;

class CreateCompanyIndexController extends Controller
{
    public function index()
    {
        return view('create-company.index');
    }
}
