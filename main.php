<?php
session_start();
function validate($x, $y, $r)
{
    if ($x<-3 || $x>3 || $y<-5 || $y>5 || $r<2 || $r>5){
        return false;
    }
    $result = false;
    if ($x>=0 && $y>=0){
        if (($r/2 - $x/2)>=$y){
            $result = true;
        }
    } elseif ($x>=0 && $y<0){
        if ($x<=$r && $y>=($r/(-2))){
            $result = true;
        }
    } elseif ($x<0 && $y<0){
        if (($x**2+$y**2)<=(($r/2)**2)){
            $result = true;
        }
    }
    return $result;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $timeStart = microtime(true);
    // collect value of input field
    try {
        $x = $_POST['x'];
        $y = $_POST['y'];
        $r = $_POST['r'];
        if (is_numeric($x) && is_numeric($y) && is_numeric($r)){
            $res = validate($x, $y, $r) ? 'Да' : 'Нет';
            /*$runTime = $timeNow + $_POST['now'];*/
            $timeNow = date("H:i:s:ms");
            $runTime = round((microtime(true) - $timeStart)*(10**6));
            $tableRow = '<tr><td>'.$x.'</td><td>'.$y.'</td><td>'.$r.'</td><td>'.$res.'</td><td>'.$runTime.' mks</td><td>'.$timeNow.'</td></tr>';
            echo $tableRow;
        } else{
            header("HTTP/1.1 400 OK");
        }
    }catch (Exception $e){
        header("HTTP/1.1 500 OK");
    }

}
