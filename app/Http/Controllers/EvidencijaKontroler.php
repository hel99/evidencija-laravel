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




    public function zaposleni()
    {
        $zaposleni = DB::table('zaposleni')->get();

        return response()->json([
            'status' => 200,
            'zaposleni' => $zaposleni
        ]);
    }



    public function zaposleniSearch($input)
    {
        $zaposleni = DB::table('zaposleni')
            ->where('first_name', 'like', "%$input%")
            ->orWhere('last_name', 'like', "%$input%")
            ->orWhere('email', 'like', "%$input%")
            ->orWhere('phone_number', 'like', "%$input%")
            ->get();

        return response()->json([
            'status' => 200,
            'zaposleni' => $zaposleni
        ]);
    }




    public function zaposleniSort($sortiranje)
    {
        $zaposleni = DB::table('zaposleni')
            ->orderBy('kasnjenja', $sortiranje)
            ->get();

        $sortiranje == 'ASC' ? $sortiranje = 'DESC' : $sortiranje = 'ASC';

        return response()->json([
            'status' => 200,
            'zaposleni' => $zaposleni,
            'sortiranje' => $sortiranje
        ]);
    }
}
