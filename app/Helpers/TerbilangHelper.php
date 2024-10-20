<?php

if (! function_exists('angkaKeTerbilang')) {
    function angkaKeTerbilang($angka) {
        $angka = abs($angka);
        $huruf = array(" ", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        
        if ($angka < 12) {
            $temp = " " . $huruf[$angka];
        } else if ($angka < 20) {
            $temp = angkaKeTerbilang($angka - 10) . " Belas ";
        } else if ($angka < 100) {
            $temp = angkaKeTerbilang($angka / 10) . " Puluh " . angkaKeTerbilang($angka % 10);
        } else if ($angka < 200) {
            $temp = " Seratus " . angkaKeTerbilang($angka - 100);
        } else if ($angka < 1000) {
            $temp = angkaKeTerbilang($angka / 100) . " Ratus " . angkaKeTerbilang($angka % 100);
        } else if ($angka < 2000) {
            $temp = " Seribu" . angkaKeTerbilang($angka - 1000);
        } else if ($angka < 1000000) {
            $temp = angkaKeTerbilang($angka / 1000) . " Ribu " . angkaKeTerbilang($angka % 1000);
        } else if ($angka < 1000000000) {
            $temp = angkaKeTerbilang($angka / 1000000) . " Juta " . angkaKeTerbilang($angka % 1000000);
        }

        return trim($temp);
    }
}
