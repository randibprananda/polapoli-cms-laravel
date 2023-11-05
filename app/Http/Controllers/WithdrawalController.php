<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WithdrawalController extends Controller
{
    public function index()
    {
        $data = Http::get(env('API_POLA_POLI_BE') . '/api/v1/cms/list/all/request/withdrawal');
        $data = json_decode($data->getBody());
        $data = $data->data->data;
        // dd($data);
        return view('dashboard.withdrawal.index', compact('data'));
    }

    public function status(Request $request, $id)
    {
        $status = 'PENDING';
        if ($request->status == 1) {
            $status = 'APPROVED';
        } elseif ($request->status == 3) {
            $status = 'REJECTED';
        }
        Http::post(env('API_POLA_POLI_BE') . '/api/v1/cms/status/request/withdrawal/' . $id, [
            'status' => $status,
        ]);

        return redirect()->back();
    }
}