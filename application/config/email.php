<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//permitir gmail  =>  https://www.google.com/settings/security/lesssecureapps
$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_port'] = 465;
$config['smtp_user'] = 'backoffice.tsl.pinhais@gmail.com';
$config['smtp_pass'] = 'ezentis1234';
$config['protocol']  = 'smtp';
$config['validate']  = TRUE;
$config['mailtype']  = 'html';
$config['charset']   = 'utf-8';
$config['newline']   = "\r\n";