<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of honestzone
 *
 * @author ASUS
 */
class honestzone {

    //put your code here

    public function converttobase64($image) {
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $data = file_get_contents($image);
        $dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $dataUri;
    }

    public function converttoimage($image, $new_image) {

        $ext = substr($new_image, -1 - 2);
        $img = str_replace('data:image/' . $ext . ';base64,', '', $image);
        $img = str_replace(' ', '+', $img);
        $pic = base64_decode($img);
        $im = imagecreatefromstring($pic);
//        $size = GetimageSize(base_url() . $image);
//        $width = $size[0];
////        $height = $size[1];
//        $height = round($width * $size[1] / $size[0]);
//        $ratio = ($width > $height) ? $max_width / $width : $max_height / $height;
//        geti
//        print_r($size);die(0);
////        $ratio = $width / $height;
//        if ($width > $height) {
//           
//        } else {
//            $width = round($height * 3 / 4);
//        }
//        if ($width > $max_width || $height > $max_height) {
//            $new_width = $width * $ratio;
//            $new_height = $height * $ratio;
//        } else {
//            $new_width = $width;
//            $new_height = $height;
//        }
        $p = $new_image;
//        $images_orig = ImageCreateFromJPEG($image);
        switch (strtolower($ext)) {
            case 'png':

                imagepng($im, $p);
                break;
            case 'jpg' || 'jpeg' :
//                $images_orig = imagecreatefromjpeg(base_url() . $image);
                imagejpeg($im, $p);
                break;
            case 'gif':
//                $images_orig = imagecreatefromgif(base_url() . $image);
                move_uploaded_file($im, $p);
                break;
            default: die();
        }
    }

    public function monthIntToString($monthInt, $fullOr3digit = '3digit', $language = 'eng') {
        if ($fullOr3digit == '3digit' && $language == 'eng') {
            switch ((int) $monthInt) {
                case '1':
                    $monthstring = 'Jan';
                    break;
                case '2':
                    $monthstring = 'Feb';
                    break;
                case '3':
                    $monthstring = 'Mar';
                    break;
                case '4':
                    $monthstring = 'Apr';
                    break;
                case '5':
                    $monthstring = 'May';
                    break;
                case '6':
                    $monthstring = 'Jun';
                    break;
                case '7':
                    $monthstring = 'Jul';
                    break;
                case '8':
                    $monthstring = 'Aug';
                    break;
                case '9':
                    $monthstring = 'Sep';
                    break;
                case '10':
                    $monthstring = 'Oct';
                    break;
                case '11':
                    $monthstring = 'Nov';
                    break;
                case '12':
                    $monthstring = 'Dec';
                    break;
            }
        } else if (strtolower($fullOr3digit) == 'full' && $language == 'eng') {
            switch ((int) $monthInt) {
                case '1':
                    $monthstring = 'January';
                    break;
                case '2':
                    $monthstring = 'February';
                    break;
                case '3':
                    $monthstring = 'March';
                    break;
                case '4':
                    $monthstring = 'April';
                    break;
                case '5':
                    $monthstring = 'May';
                    break;
                case '6':
                    $monthstring = 'June';
                    break;
                case '7':
                    $monthstring = 'July';
                    break;
                case '8':
                    $monthstring = 'August';
                    break;
                case '9':
                    $monthstring = 'September';
                    break;
                case '10':
                    $monthstring = 'October';
                    break;
                case '11':
                    $monthstring = 'November';
                    break;
                case '12':
                    $monthstring = 'December';
                    break;
            }
        } else if (strtolower($fullOr3digit) == 'full' && $language == 'in') {
            switch ((int) $monthInt) {
                case '1':
                    $monthstring = 'Januari';
                    break;
                case '2':
                    $monthstring = 'Febuari';
                    break;
                case '3':
                    $monthstring = 'Maret';
                    break;
                case '4':
                    $monthstring = 'April';
                    break;
                case '5':
                    $monthstring = 'Mei';
                    break;
                case '6':
                    $monthstring = 'Juni';
                    break;
                case '7':
                    $monthstring = 'Juli';
                    break;
                case '8':
                    $monthstring = 'Agustus';
                    break;
                case '9':
                    $monthstring = 'September';
                    break;
                case '10':
                    $monthstring = 'Oktober';
                    break;
                case '11':
                    $monthstring = 'November';
                    break;
                case '12':
                    $monthstring = 'Desember';
                    break;
            }
        }
        return $monthstring;
    }

    public function loadMonth($type) {
        if ($type == "short") {
            $month = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        } else if ($type == "long") {
            $month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        } else {
            $month = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        }

//        return $monthNum;
//        return $monthLong;
        return $month;
    }

}
