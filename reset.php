<?php

//Instantiate our PDO object and create a new MySQL connection.
$pdo = new PDO('mysql:host=logiscool;dbname=userdb', 'root', '');
//Connect to MySQL using PDO.

//The name of the table that you want to copy.
$currentTable = 'timesheet';

//The name of the new table.
$newTableName = 'timesheet_copy';

//Run the CREATE TABLE new_table LIKE current_table
$pdo->query("CREATE TABLE $newTableName LIKE $currentTable");

//Import the data from the old table into the new table.
$pdo->query("INSERT $newTableName SELECT * FROM $currentTable");
//Our SQL statement. This will empty / truncate the table "videos"
$sql = "TRUNCATE TABLE `timesheet`";

//Prepare the SQL query.
$statement = $pdo->prepare($sql);

//Execute the statement.
$statement->execute();
?>