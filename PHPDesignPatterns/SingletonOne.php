<?php

include "Singleton.php";

$objectA = DBConnection::getInstance();
$objectB = DBConnection::getInstance();
$objectC = DBConnection::getInstance();