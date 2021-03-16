<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Vyuldashev\XmlToArray\XmlToArray;
use Illuminate\Support\Str;

class CurencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = 'http://www.cbr.ru/scripts/XML_daily.asp';
        $dataInsert = [];

        for($i = 0; $i < 30; $i++) {
            $date_req = now()->subDay($i)->format('d/m/Y');
            $req = Http::get($url, [$date_req]);
            $resp = XmlToArray::convert($req->body());

            $date = now()->subDay($i)->format('Y-m-d');
            foreach($resp['ValCurs']['Valute'] as $valute){
                $dataInsert[] = [
                    'valuteID' => $valute['_attributes']['ID'],
                    'numCode' => $valute['NumCode'],
                    'сharCode' => $valute['CharCode'],
                    'name' => $valute['Name'],
                    'value' => Str::replaceFirst(',', '.', $valute['Value']),
                    'date' => $date,
                ];
            }
        }

        DB::table('currency')->insert($dataInsert);
    }
}
