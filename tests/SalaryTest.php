<?php

class SalaryTest extends PHPUnit_Framework_TestCase
{
    public function testIsWritable()
    {
        echo "\n";
        if ( is_writable('../') )
        {
            print_r('Folder is writable');
        }
        else
        {
            print_r('Folder is not writable');
        }
    }
    
    public function testCalculation()
    {
        $salary = new Salary('Hello', 'y', true);
        $salary->execute();
    }
}
