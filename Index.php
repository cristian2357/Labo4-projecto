<?php

require 'fw/Database.php';
require 'tests/TestValidaciones.php';

TestValidaciones::testValidacionAutomatica();   // Ej de test: falla si, por ej, dentro de un dato numerico llega algun caracter de escape, ya que lo considera un string