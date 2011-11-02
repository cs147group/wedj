<?php
        $dbHost = "mysql.cs147.org";
        $dbUser = "jpulvera";
        $dbPass = "eymQqu6V";
        $dbDatabase = "jpulvera_mysql";
        $db = mysql_connect("mysql.cs147.org", "jpulvera", "eymQqu6V") or die ("Error connecting to database
:(");
        $db_found = mysql_select_db("$dbDatabase", $db) or die ("Couldn't select the database");
        echo "i believe your database connection worked!\n";
?>

