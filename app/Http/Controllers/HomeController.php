<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetCurencyRequest;
use App\Models\Curency;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $reqDate = Curency::max('date');
        $curenciesCharCode = Curency::select('charCode')->distinct()->get();

        //$validateInput = Validator::make($request->all(), $rules);

        //$req = request()->all();
        if($request->all()){

            $rules = [
                'charCode' => 'required|exists:currency,charCode',
                'from' => 'required|date',
                'to' => 'required|date|after_or_equal:from',
            ];

            $validateData = $request->validate($rules);

            $curencies = Curency::where('date', '>=', $validateData['from'])
                    ->where('date', '<=', $validateData['to'])
                    ->whereIn('charCode', $validateData['charCode'])
                    ->get()
                    // ->groupBy('charCode')
            ;
            if ($curencies) {
                //dd($curencies);
                return view('home', compact('reqDate', 'curenciesCharCode', 'curencies'));
            } else {
                return back()
                    ->withErrors(['msg' => 'No get curencies']);
            }
        }

        return view('home', compact('reqDate', 'curenciesCharCode'));
    }
}
