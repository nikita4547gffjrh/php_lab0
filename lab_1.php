<?php
function calculate(string $str) {
    $mass = str_split($str);
    $str1 = preg_replace('/[^a-zа-я]/ui', '', $str);
    if(mb_strlen($str1) > 0) {
        echo "Error";
        return;
    }
    $a = 0; $b = 0; $sign = 0;
    for($i = 0; $i < mb_strlen($str); $i++) {
        if($mass[$i] === "-") {
            $a++; $sign = 1; $b = $i;
        }
        if($mass[$i] === "+"){
            $a++; $sign = 2; $b = $i;
        } 
    }
    if($a < 1 || $a > 1) {
        echo "Error";
        return;
    }
    $numbers = "0123456789";
    $number_mass = str_split($numbers);
    $st = 0; $stt = 0; $sm = 0;
    for($i = 0; $i < mb_strlen($str); $i++) {
        for($g = 0; $g < mb_strlen($numbers); $g++) {
            if($mass[$i] === $number_mass[$g] && $i < $b) {
                $st = $st . $mass[$i];
            }
            if($mass[$i] === $number_mass[$g] && $i > $b) {
                $stt = $stt . $mass[$i];
            }
        }
    }
    if($sign == 1) $sm = $st - $stt;
    if($sign == 2) $sm = $st + $stt;
    return $sm;
}
$faut = calculate('22 + 8');
echo $faut;
?>