<?php

// Pick and filter first argument (output filename)
echo "Please specify name of output file:";

$handle = fopen("php://stdin","r");
$filename = trim(fgets($handle));
preg_match("/^[a-zA-Z0-9]+$/", $filename);

if ( strlen($filename) < 4 )
{
    echo 'Name should contain at least 4 symbols.'."\n";
    exit;
}

// Pick second argument (optional) (adds to filename current date)
echo "Do you want to add current date to filename? (y/n)";
$date = trim(fgets($handle));

include 'src/autoload.php';

$salary = new Salary($filename, $date, false);
$salary->execute();

?>
