<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CurencyGetRequest;
use App\Models\Curency;
use Illuminate\Http\Request;
use Flugg\Responder\Responder;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
//use Validator;

class CurencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurency(Request $request, Responder $responder)
    {
        $rules = [
            'valuteID' => 'required|exists:currency,valuteID',
            'from' => 'required|date',
            'to' => 'required|date|after:from',
        ];

        $validateInput = Validator::make($request->all(), $rules);

        if($validateInput->fails()){
            $statusCode = 400;
            $messages = $validateInput->errors();
            //dd($messages);
            return $responder->error($statusCode, $messages)->respond($statusCode);
        } else {
            $data = $request->input();
            $from = Carbon::make($data['from'])->format('Y-m-d');
            $to = Carbon::make($data['to'])->format('Y-m-d');
            // dd($from, $to);

            $curencies = Curency::where('date', '>=', $from)
                    // ->end()
                    ->where('date', '<=', $to)
                    ->where('valuteID', $data['valuteID'])
                    ->get()
            ;

            return $responder->success($curencies);
        }
    }
}
