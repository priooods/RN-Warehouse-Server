<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class Controller
{
    public function validasi(Request $request, $rules, $message = null){
        $validasi = Validator::make($request->all(), $rules, $message);
        if($validasi->fails()) { abort(402, $validasi->errors()->all()); }
        return null;
    }

    public function success($msg, $data, $notif = null, $code = 200){
        return response()->json(
            [
                'res_message' => $msg,
                'res_data' => $data,
                'notif' => $notif,
            ], $code
        );
    }
}
