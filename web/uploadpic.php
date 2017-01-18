<?php
/**
 * Created by PhpStorm.
 * User: akshay
 * Date: 28/2/15
 * Time: 12:58 PM
 */

if(!empty($_POST['picdata'])) {
    $success = false;
    $data = $_POST['picdata'];
    $filename = md5(rand(1,20).time()).'.png';

    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);       //decode image

    if(file_put_contents('uploads/'.$filename, $data))  {       //save image to upload folder
        $success = true;
    }

    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-type: application/json');
    echo json_encode(array('success' => $success));
}