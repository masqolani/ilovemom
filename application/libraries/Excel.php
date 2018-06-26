<?php

/* GPL
 * GPL To change this license header, choose License Headers in Project Properties.
 * GPL To change this template file, choose Tools | Templates
 * GPL and open the template in the editor.
 */
/*
 * name        : Salman Farisi<salmandriva@gmail.com>
 * skype       : salmandriva
 * YM          : s4lm4ndrake
 * G+          : plus.google.com/salmandriva
 * blog/web    : http://ketikan10jari.wordpress.com
 * facebook    : facebook.com/salmandriva
 */
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  ======================================= 
 *  Author     : Muhammad Surya Ikhsanudin 
 *  License    : Protected 
 *  Email      : mutofiyah@gmail.com 
 *   
 *  Dilarang merubah, mengganti dan mendistribusikan 
 *  ulang tanpa sepengetahuan Author 
 *  ======================================= 
 */  
require_once APPPATH."/third_party/PHPExcel.php"; 
 
class Excel extends PHPExcel { 
    public function __construct() { 
        parent::__construct(); 
    } 
}
?>