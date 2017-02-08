<?php
/**
 * Created by PhpStorm.
 * User: selimreza
 * Date: 1/16/17
 * Time: 3:39 PM
 */

namespace App\Http\Helpers;


class ImportDatabase
{

    /**
     * @param $sql_file_or_content
     * @return string
     */
    public function import_tables($sql_file_or_content)
    {

        $host = '127.0.0.1';
        $user = 'reza';
        $pass = 'Rez@1986';
        $database_name = 'haber_dev';
        set_time_limit(3000);

        $SQL_CONTENT = (strlen($sql_file_or_content) > 300 ?  $sql_file_or_content : file_get_contents($sql_file_or_content)  );

        $allLines = explode("\n",$SQL_CONTENT);

        $mysqli = new \mysqli($host, $user, $pass, $database_name);
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $foreign_key_checks = $mysqli->query('SET foreign_key_checks = 0');
        preg_match_all("/\nCREATE TABLE(.*?)\`(.*?)\`/si", "\n". $SQL_CONTENT, $target_tables);

        foreach ($target_tables[2] as $table)
        {
            $mysqli->query('DROP TABLE IF EXISTS '.$table);
        }

        $foreign_key_checks = $mysqli->query('SET foreign_key_checks = 1');
        $mysqli->query("SET NAMES 'utf8'");

        $templine = '';	// Temporary variable, used to store current query

        foreach ($allLines as $line)	// Loop through each line
        {
                if (substr($line, 0, 2) != '--' && $line != '')
                {
                    $templine .= $line; 	// (if it is not a comment..) Add this line to the current segment

                    if (substr(trim($line), -1, 1) == ';') // If it has a semicolon at the end, it's the end of the query
                    {
                        if(!$mysqli->query($templine))
                        {
                            print('Error performing query \'<strong>' . $templine . '\': ' . $mysqli->error . '<br /><br />');
                        }

                        $templine = ''; // set variable to empty, to start picking up the lines after ";"
                    }
                }

        }
        return 'Importing finished. Now, Delete the import file.';


    }








}