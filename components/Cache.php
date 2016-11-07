<?php

namespace app\components;

trait Cache {

    public function myInit() {
        header('Expires: Fr, 07 Nov 2016 15:38:00 GMT');
        header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

}