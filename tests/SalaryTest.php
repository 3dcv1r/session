<?php

class SalaryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Check is writable directory for final output file
     */
    public function testIsWritable()
    {
        if ( is_writable('../') )
        {
            $this->assertTrue(true);
            $result = 'Folder is writable';
        }
        else
        {
            $this->assertTrue(false);
            $result = 'Folder is not writable';
        }

        echo "\n" . $result . "\n";
    }

    /**
     * Simple test case to run application and display output in console
     */
    public function testCalculation()
    {
        $salary = new Salary('Hello', 'y', true);
        $salary->execute();
    }
}
