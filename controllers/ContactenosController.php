<?php

require '../cfg/Configuration.php';
require Configuration::getAbsolutePath() . '/fw/fw.php';
require Configuration::getAbsolutePath() . '/views/ContactenosView.php';

$v = new ContactenosView();

$v->render();