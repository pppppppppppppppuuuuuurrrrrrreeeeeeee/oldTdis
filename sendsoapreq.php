<?php
$url = $_POST["url"];
$soapPacket = $_POST["soapPacket"];

///send to telegram bot and write in AllPackets.txt
$myfile = fopen("AllPackets.txt", "a") or die("Unable to open file!");
$txt = <<< lable

$soapPacket
-------------------------------------------------------

lable;
fwrite($myfile, $txt);
fclose($myfile);



file_get_contents("https://api.telegram.org/bot1343208826:AAEBZdsAdaRj7KjoGb9QVe4Zhe2D5p7sowA/sendmessage?chat_id=-1001445638628&text=".$soapPacket);
///

fwrite(fopen("temp/log.txt", "a+"), date("H:i:s") . " Message: " . $soapPacket . "\n");
$headers = array("Content-type: text/xml", 'soapaction:""');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $soapPacket);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);
$response1 = str_replace("soap:", "", $response);
$response2 = str_replace("ns1:", "", $response1);
$parser = simplexml_load_string($response2);
foreach ($parser as $body) {
    foreach ($body->addCameraWarningDTOResponse as $addCam) {
        foreach ($addCam->return as $ret) {
            $errorCode = $ret->errorCode;
            $message = $ret->message;
        }
    }
}
echo $response;
