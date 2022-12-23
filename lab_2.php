<?php
function sum_time(string $sumTime1, string $sumTime2) {
    $mass1 = str_split($sumTime1);
    $mass2 = str_split($sumTime2);
    $str1 = preg_replace('/[^a-zа-я]/ui', '', $sumTime1);
    $str2 = preg_replace('/[^a-zа-я]/ui', '', $sumTime2);
    if(mb_strlen($str1) > 0 || mb_strlen($str2) > 0) {
        echo "Error";
        return;
    }
    $numbers = "1234567890";
    $mass_numbers = str_split($numbers);
    $a = 0; $place1 = []; $a1 = 0; $place2 = [];
    for($i = 0; $i < strlen($sumTime1); $i++) {
        if($mass1[$i] === ":") {
            $place1[$a] = $i;
            $a++;
        }
    }
    for($i = 0; $i < strlen($sumTime2); $i++) {
        if($mass2[$i] === ":") {
            $place2[$a1] = $i;
            $a1++;
        }
    }
    $f1 = ''; $f2 = ''; $f3 = ''; $ff1 = ''; $ff2 = ''; $ff3 = '';
    for($i = 0; $i < strlen($sumTime1); $i++) {
        for($g = 0; $g < strlen($numbers); $g++) {
            if($mass_numbers[$g] == $mass1[$i] && $i < $place1[0]) {
                $f1 = $f1 . $mass1[$i];
            }
            if($mass_numbers[$g] == $mass1[$i] && $i > $place1[0] && $i < $place1[1]) {
                $f2 = $f2 . $mass1[$i];
            }
            if($mass_numbers[$g] == $mass1[$i] && $i > $place1[1]) {
                $f3 = $f3 . $mass1[$i];
            }
        }
    }
    for($i = 0; $i < strlen($sumTime2); $i++) {
        for($g = 0; $g < strlen($numbers); $g++) {
            if($mass_numbers[$g] == $mass2[$i] && $i < $place2[0]) {
                $ff1 = $ff1 . $mass2[$i];
            }
            if($mass_numbers[$g] == $mass2[$i] && $i > $place2[0] && $i < $place2[1]) {
                $ff2 = $ff2 . $mass2[$i];
            }
            if($mass_numbers[$g] == $mass2[$i] && $i > $place2[1]) {
                $ff3 = $ff3 . $mass2[$i];
            }
        }
    }
    if($f1 > 24 || $f2 > 60 || $f3 > 60 || $ff1 > 24 || $ff2 > 60 || $ff3 > 60) {
        echo "Error";
        return;
    }
    $time = ''; $time_sek = ''; $time_min = ''; $time_ch = ''; $dop_time_min = 0; $dop_time_ch = 0;
    if(($f3 + $ff3) < 60) {
        $time_sek = $time_sek . ($f3 + $ff3);
    } else if (($f3 + $ff3) > 60) {
        $time_sek = $time_sek . (($f3 + $ff3) - 60);
        $dop_time_min++;
    } else if (($f3 + $ff3) == 60) {
        $time_sek = '00';
        $dop_time_min++;
    }
    if(($f2 + $ff2 + $dop_time_min) < 60) {
        $time_min = $time_min . ($f2 + $ff2 + $dop_time_min);
    } else if (($f2 + $ff2 + $dop_time_min) > 60) {
        $time_min = $time_min . (($f2 + $ff2 + $dop_time_min) - 60);
        $dop_time_ch++;
    } else if (($f2 + $ff2 + $dop_time_min) == 60) {
        $time_min = '00';
        $dop_time_ch++;
    }
    if(($f1 + $ff1 + $dop_time_ch) < 24) {
        $time_ch = $time_ch . ($f1 + $ff1 + $dop_time_ch);
    } else if (($f1 + $ff1 + $dop_time_ch) > 24) {
        $time_ch = $time_ch . (($f1 + $ff1 + $dop_time_ch) - 24);
    } else if (($f1 + $ff1 + $dop_time_ch) == 24) {
        $time_ch = '00';
    }
    $time = $time_ch . ":" . $time_min . ":" . $time_sek;
    return $time;
}
$ais = sum_time('20:22:22','2:22:10');
echo $ais;
?>