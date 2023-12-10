<?php
require_once "include/classes/meekrodb.2.3.class.php";
DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'arshaphp';
DB::$host = 'localhost';

// Test the connection
DB::query("SELECT 1");
?>
