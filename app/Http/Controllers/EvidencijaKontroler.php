<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\DB;

class EvidencijaKontroler extends Controller
{

    public function checkLogin($id)
    {
        $date1 = new DateTime();
        $date1->setTimezone(new DateTimeZone('Europe/Belgrade'));
        $date1->setTime(8, 0);

        $date2 = new DateTime();
        $date2->setTimezone(new DateTimeZone('Europe/Belgrade'));
        $date2->setTime(8, 30);

        $date3 = new DateTime();
        $date3->setTimezone(new DateTimeZone('Europe/Belgrade'));
        $date3->setTime(16, 0);


        $loginTime = new DateTime();
        $loginTime->setTimezone(new DateTimeZone('Europe/Belgrade'));

        if ($loginTime > $date1 && $loginTime < $date2) {
            DB::table('prisustva')->insert([
                'zaposleni_id' => $id,
                'prijava' => $loginTime
            ]);
        } else {
            DB::table('kasnjenja')->insert([
                'zaposleni_id' => $id,
                'prijava' => $loginTime
            ]);

            $brojKasnjenjaZaposleni = DB::table('kasnjenja')->where('zaposleni_id', $id)->get()->count();

            DB::table('zaposleni')->where('id', $id)
                ->update([
                    'kasnjenja' => $brojKasnjenjaZaposleni
                ]);

            return response()->json([
                'brojKasnjenjaZaposleni' => $brojKasnjenjaZaposleni
            ]);
        }
    }





    public function prisustva()
    {
        $prisustva = DB::table('prisustva')->join('zaposleni', 'zaposleni.id', '=', 'prisustva.zaposleni_id')->get();

        return response()->json([
            'status' => 200,
            'prisustva' => $prisustva
        ]);
    }




    public function kasnjenja()
    {
        $kasnjenja = DB::table('kasnjenja')->join('zaposleni', 'zaposleni.id', '=', 'kasnjenja.zaposleni_id')->get();

        return response()->json([
            'status' => 200,
            'kasnjenja' => $kasnjenja
        ]);
    }
}
