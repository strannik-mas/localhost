<?
error_reporting(E_ALL);
session_start();
session_destroy();
//session_start();
session_name('abc');
echo session_name();