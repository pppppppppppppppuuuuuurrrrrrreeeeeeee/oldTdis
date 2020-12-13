<?php
require __DIR__.'/functions.php';
require_once './ChromePhp.php';

date_default_timezone_set('Asia/Tehran');
$now = date('Y-m-d H_i_s');
$radio = filter_input(INPUT_POST, 'radio');

if($radio == 'map') {
    $tbody = filter_input(INPUT_POST, 'tbody');
    $svg = filter_input(INPUT_POST, 'svg');
    $svg = str_replace('width="500"', 'width="600"', $svg);
    $template = str_replace(['{svg}', '{tbody}'], [$svg, $tbody], file_get_contents('./templates/mapExport.html'));
    if (file_put_contents("./export/$now.html", $template) !== FALSE) {
        echo "export/$now.html";
    } else {
        echo "fail";
    }
} else if($radio == 'usr')
{
    $tbody = filter_input(INPUT_POST, 'tbody');
    $obsImg = filter_input(INPUT_POST, 'obsImg');
    $editsImg = filter_input(INPUT_POST, 'editsImg');
    $sendToPoliceImg = filter_input(INPUT_POST, 'sendToPoliceImg');
    $reportsImg = filter_input(INPUT_POST, 'reportsImg');

    $template = str_replace(['{tbody}', '{observes}', '{edits}', '{sents}', '{reports}'], [$tbody, $obsImg, $editsImg, $sendToPoliceImg, $reportsImg], file_get_contents('./templates/userExport.html'));
    
    if (file_put_contents("./export/$now.html", $template) !== FALSE) {
        echo "export/$now.html";
    } else {
        echo "fail";
    }
} else if($radio == 'cam') {
    $tbody = filter_input(INPUT_POST, 'tbody');
    $CamObsImg = filter_input(INPUT_POST, 'CamObsImg');
    $CamUnseenImg = filter_input(INPUT_POST, 'CamUnseenImg');
    $CamEditImg = filter_input(INPUT_POST, 'CamEditImg');
    $CamSentImg = filter_input(INPUT_POST, 'CamSentImg');
    $CamUnsentImg = filter_input(INPUT_POST, 'CamUnsentImg');
    $CamRepImg = filter_input(INPUT_POST, 'CamRepImg');
    $CamRecImg = filter_input(INPUT_POST, 'CamRecImg');
    $repTable = filter_input(INPUT_POST, 'repTable');

    $template = str_replace(['{tbody}', '{tbodyREP}', '{sent}', '{unsent}', '{observed}', '{unseen}', '{allrec}', '{rep}', '{edit}'], [$tbody, $repTable, $CamSentImg, $CamUnsentImg, $CamObsImg, $CamUnseenImg, $CamRecImg, $CamRepImg, $CamEditImg], file_get_contents('./templates/camExport.html'));

    
    if (file_put_contents("./export/$now.html", $template) !== FALSE) {
        echo "export/$now.html";
    } else {
        echo "fail";
    }
}