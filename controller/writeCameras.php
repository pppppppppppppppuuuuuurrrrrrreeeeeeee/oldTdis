<?php
require_once __DIR__.'/../model/config.php';
require_once __DIR__.'/../model/functions.php';

function writeCameras() {
    $camera = readCameras();
    foreach ($camera as &$cam) {
        $name = $cam[0];
        $id = $cam[1];
        $enable = $cam[2];
        $icon = 'videocam';
        if ($enable == 0)
            $icon = 'videocam_off';
        echo <<< label
        <a onclick="changeCameraText(this)" data-toggle="tooltip" data-placement="right" title="$id" id="$id">
            <i class="material-icons icon">
                $icon
            </i>
            $name
        </a>
label;
    }
} 