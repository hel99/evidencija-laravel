<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Log;
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
        }
    }
}
