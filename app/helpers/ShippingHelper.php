<?php

class ShippingHelper
{
public static function distanceFromSurabaya($city)
{
    $city = strtolower(trim($city));

    return match ($city) {

        // Jawa Timur
        'surabaya'      => 0,
        'sidoarjo'      => 25,
        'malang'        => 90,
        'pasuruan'      => 70,
        'probolinggo'   => 100,
        'kediri'        => 130,
        'jember'        => 200,
        'banyuwangi'    => 280,

        // Jawa Tengah
        'semarang'      => 350,
        'solo'          => 300,
        'yogyakarta'    => 330,
        'purwokerto'    => 420,
        'tegal'         => 500,

        // Jawa Barat
        'jakarta'       => 800,
        'bogor'         => 780,
        'depok'         => 770,
        'tangerang'     => 820,
        'bekasi'        => 810,
        'bandung'       => 700,
        'cirebon'       => 600,
        'tasikmalaya'   => 650,

        // Sumatra
        'medan'         => 2000,
        'binjai'        => 1980,
        'pekanbaru'     => 1600,
        'padang'        => 1700,
        'jambi'         => 1500,
        'palembang'     => 1400,
        'bandar lampung'=> 1100,

        // Kalimantan
        'pontianak'     => 1200,
        'palangkaraya'  => 1300,
        'banjarmasin'   => 900,
        'balikpapan'    => 800,
        'samarinda'     => 820,

        // Bali & NT
        'denpasar'      => 420,
        'mataram'       => 550,
        'bima'          => 900,

        // Sulawesi
        'makassar'      => 900,
        'parepare'      => 950,
        'manado'        => 1600,
        'palu'          => 1400,

        default         => 1800,
    };
}


    public static function calculateOngkir($distance)
    {
        // misal Rp 10 per km
        return $distance * 10;
    }

    // Tambahkan ini supaya tidak error
    public static function estimateDistance($city)
    {
        return self::distanceFromSurabaya($city);
    }
}
