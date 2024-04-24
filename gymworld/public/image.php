<?php
$imageName = $_GET['image'];

$imageName = basename($imageName);

$file = "uploads/$imageName";

if (file_exists($file)) {
    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    header('Pragma: no-cache');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
    header('Content-Type: image/png');
    readfile($file);
}