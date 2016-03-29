<?php

/**
* PHP class for calculating sallary and bonuses
* and write csv output
**/

class Salary
{
    public $filename;
    private $date;
    private $test;

    public function __construct($filename = null, $date = null, $test = false)
    {
	    $this->filename = $filename;
	    $this->date 	= $date;
        $this->test     = $test;
    }

    public function execute()
    {
	    // add date if argument is required
        if( trim($this->date) == 'y')
        {
            $this->filename .= '-' . date('Y-m-d', time());
        }

        // build output depending on algorithm
        $this->buildOutput();

        // print file name in normal mode
        if ( $this->test !== true )
        {
            echo $this->filename . "\n";
        }
    }

    private function buildOutput()
    {
        $month = date('m', time());
        $output = [
            [
                'Month',
                'Payment date',
                'Bonus date'
            ]
        ];

        // loop for each 12 month from current
        for ( $i = 1; $i <= 12; $i++ )
        {
            // pick 15 of the month
            $date = gmmktime(12, 0, 0, $month + $i, 15);

            $bonus = $this->calculateBonus($date);

            $paymentDate = $this->calculatePaymentDay($month, $date, $i);

            // collect values in final array
            $output[$i] = [
                date('F', $date),
                $paymentDate,
                $bonus
            ];
        }

        // write file
        $this->writeOutput($output);
    }

    /**
     * @param $date
     * @return date
     */
    private function calculateBonus($date)
    {
        // use 15 if it's weekend | weekdays N [1..7]
        if ( date('N', $date) > 5 )
        {
            return date('Y-m-d', strtotime('next wednesday', $date));
        }
        // use next wadnesday if it isn't
        else
        {
            return date('Y-m-d', $date);
        }
    }

    /**
     * @param $month current month
     * @param $date current iteration date
     * @param $i current iteration month
     * @return date
     */
    private function calculatePaymentDay($month, $date, $i)
    {
        // get last day of months
        $payday = gmmktime(12, 0, 0, $month + $i, date('t', $date));

        // if it's weeend use the last day of month
        if ( date('N', $payday) < 6 )
        {
            return date('Y-m-d', $payday);
        }
        // if it isn't use last weekday of the month
        else
        {
            return date('Y-m-d', strtotime('last weekday '.date('Y-m-d', $payday)));
        }
    }

    /**
     * @param $output array with output
     */
    private function writeOutput($output)
    {
        if ( $this->test !== true )
        {
            $this->writeFile($output);
        }

        // print to console if testmode is enabled
        if ( $this->test == true )
        {
            echo "\n";

            foreach ($output as $fields)
            {
                foreach ($fields as $field)
                {
                    echo $field . ' | ';
                }
                echo "\n";
            }
        }

    }

    private function writeFile($output)
    {
        // build filepath
        $path = __DIR__ .'/../'. $this->filename . '.csv';

        // open file stream
        $fp = fopen($path, 'w');

        // write csv file
        foreach ($output as $fields)
        {
            fputcsv($fp, $fields, ',', '"');
        }

        // close file stream
        fclose($fp);
    }
}
