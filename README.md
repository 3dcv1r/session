# Simple test application for salary calculation
===============================================
Format of the Application
The output of the utility should be a CSV file, containing the payment dates for the next twelve months. The CSV file should contain a column for the month name, a column that contains the salary payment date for that month, and a column that contains the bonus payment date.

### 1) Simple phpunit tests are available by command

```
$ phpunit
...

```

### 2) Application works in cli mode.

You just need to specify output file name and date option. Example of usage:

```
$ php application.php
Please specify name of output file: Hello
Do you want to add current date to filename? (y/n) y
...

```

