<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TimRelawanController extends Controller
{

    public function index()
    {
        $data = Http::get(env('API_POLA_POLI_BE') . '/api/v1/cms/list/all/tim');
        $data = json_decode($data->getBody());
        $data = $data->data;
        return view('dashboard.tim-relawan.index', compact('data'));
    }
}