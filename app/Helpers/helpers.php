<?php

if (!function_exists('imageToBase64')) {
    function imageToBase64($path)
    {
        $data = file_get_contents($path);
        if ($data === false) {
            return null;
        }
        $base64Image =
            'data:image/' .
            pathinfo($path, PATHINFO_EXTENSION) .
            ';base64,' .
            base64_encode($data);
        return $base64Image;
    }
}
