<?php

// CEFNS connection info
/*define("HOST", "tund.cefns.nau.edu");
define("USER", "ph289");
define("PASSWORD", "mQrGLs5ms7bW6K6M");
define("DATABASE", "ph289");*/

// localhost connection info
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "ph289");

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE) or die("Failed to connect");
