<?php

namespace app\components;

use Yii;

class ImageResize {

    private $prx;
    private $file;
    private $from;
    private $to;
    private $width;
    private $height;

    public function __construct($file, $from, $to, $width = '', $height = '', $prx = '') {
        $this->file = $file;
        $this->from = Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $from;
        $this->to = Yii::$app->basePath . '/web' . Yii::$app->params['params']['pathToImage'] . $to;
        $this->width = $width;
        $this->height = $height;
        $this->prx = $prx;
    }

    private function valid() {
        if (file_exists($this->from . $this->file)) {
            if (exif_imagetype($this->from . $this->file) == IMAGETYPE_GIF ||
                exif_imagetype($this->from . $this->file) == IMAGETYPE_JPEG ||
                exif_imagetype($this->from . $this->file) == IMAGETYPE_PNG) {
                return true;
            }
        }
        return false;
    }

    private function getType() {
        if ($this->valid()) {
            $type = '';
            if (exif_imagetype($this->from . $this->file) == IMAGETYPE_GIF) {
                $type = 'gif';
            }
            if (exif_imagetype($this->from . $this->file) == IMAGETYPE_JPEG) {
                $type = 'jpeg';
            }
            if (exif_imagetype($this->from . $this->file) == IMAGETYPE_PNG) {
                $type = 'png';
            }
            return $type;
        }
        return false;
    }

    private function getSize() {
        if ($this->valid()) {
            return getimagesize($this->from . $this->file);
        }
        return false;
    }

    private function getCoef() {
        if (!$this->getSize() || (empty($this->width) && empty($this->height))) {
            return false;
        }

        $width = $this->getSize()[0];
        $height = $this->getSize()[1];

        if (!empty($this->width) && empty($this->height)) {
            return ($height / ($width / 100)) / 100;
        }
        elseif (empty($this->width) && !empty($this->height)) {
            return ($width / ($height / 100)) / 100;
        }
        else {
            return true;
        }
    }

    public function resize() {
            if (!$this->getCoef()) {
                return false;
            }

            if (!empty($this->width) && empty($this->height)) {
                $this->height = $this->width * $this->getCoef();
            }
            if (empty($this->width) && !empty($this->height)) {
                $this->width = $this->height * $this->getCoef();
            }

        if (!file_exists($this->to . $this->prx . '_' . $this->width . '_' . $this->height . '_' . $this->file)) {

            $type = $this->getType();

            $desk = imageCreateTrueColor($this->width, $this->height);
            imageAlphaBlending($desk, false);
            imageSaveAlpha($desk, true);
            $funk = 'imagecreatefrom' . $type;
            $imgCreate = $funk($this->from . $this->file);
            imagecopyresampled($desk, $imgCreate, 0, 0, 0, 0, $this->width, $this->height, $this->getSize()[0], $this->getSize()[1]);

            $image = 'image' . $type;

            $image($desk, $this->to . $this->prx . '_' . $this->file);
            imagedestroy($desk);
            return true;
        } else {
            return false;
        }
    }

}