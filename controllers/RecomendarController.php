<?php

require '../cfg/Configuration.php';
require Configuration::getAbsolutePath() . '/fw/fw.php';
require Configuration::getAbsolutePath() . '/views/RecomendarView.php';

$v = new RecomendarView();

$v->render();