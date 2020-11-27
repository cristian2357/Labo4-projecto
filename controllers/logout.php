<?php

session_start();
unset($SESSION['logueado']);
header("Location: LogController.php");