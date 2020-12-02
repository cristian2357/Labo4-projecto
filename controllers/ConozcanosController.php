<?php
//NAV
require '../cfg/Configuration.php';
require Configuration::getAbsolutePath() . '/fw/fw.php';
require Configuration::getAbsolutePath() . '/views/ConozcanosView.php';

$v = new ConozcanosView();

$v->render();