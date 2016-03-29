<?php

// request of first argument
echo "Please specify name of output file:";

// pick STDIT
$handle = fopen("php://stdin","r");

// first argument filtering and validation
$filename = trim(fgets($handle));
preg_match("/^[a-zA-Z0-9]+$/", $filename);

if ( strlen($filename) < 4 )
{
    echo 'Name should contain at least 4 symbols.'."\n";
    exit;
}

// request second argument (optional)
echo "Do you want to add current date to filename? (y/n)";
$date = trim(fgets($handle));

// include autoload and run application
include 'src/autoload.php';

$salary = new Salary($filename, $date, false);
$salary->execute();

?>
