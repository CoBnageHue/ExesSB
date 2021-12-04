<?php
$cfg_array = parse_ini_file("params.ini", true);
//ini_set('session.gc_maxlifetime', 3600);
//ini_set('session.cookie_lifetime', 3600);
try {
    $db = new PDO("mysql:host=$cfg_array[host];dbname=$cfg_array[name]",$cfg_array['user'], $cfg_array['pass']);
} catch (PDOException $e) {
    print "Has errors: " . $e->getMessage();
    die();
}