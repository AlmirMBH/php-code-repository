<!DOCTYPE html>
<html lang="en">
<head><title>Date and time</title>
</head>
<body>
    <h1>Date and time</h1>

    <?php

        // Carbon is a library that is used as a wrapper around date objects
        // First parameter: tommorow, tomorrow 3:35pm, next thursday, last day of month, tomorrow noon...
        // Second parameter is time zone; list of supported time zones is available in php docs
        $timeZone = new DateTime();
                
        $dateTime1 = new DateTime();                
        $dateTime2 = new DateTime('next thursday 3:35pm');        
        $dateTime3 = new DateTime('now', new DateTimeZone('Europe/London'));        
        $dateTime4 = new DateTime('next thursday 3:35pm', new DateTimeZone('Europe/Copenhagen'));
        
        $timeZone->setTimezone(new DateTimeZone('America/Los_Angeles'));
        $timeZone->setDate(2023, 4, 24)->setTime(14, 15);
        $getTimeZone = $timeZone->getTimezone()->getName() . ' - ' . $timeZone->format('m/d/Y g:i A');

            echo "<pre>";
                print_r($dateTime1);
                print_r($dateTime2);
                print_r($dateTime3);
                print_r($dateTime4);
                print_r($timeZone);
                echo $getTimeZone;
            echo "</pre>";


        // day/month/year - europe
        // year/month/day - us
        // If European date & time format are required, don't use '/'; use '.' and '-'                
        $date = '12/05/2022 3:30pm';
        $dateTime5 = new DateTime(str_replace('/', '-', $date)); // output without str_replace would be 2022-15-05 (error)
        $dateTime6 = DateTime::createFromFormat('d/m/Y g:iA', $date);

            echo "<pre>";
                print_r($dateTime5);            
                print_r($dateTime6);                        
            echo "<pre>";


        // Procedural functions that can be used instead of objects and methods
        $dateTime7 = date_create(); 
        $dateTime8 = date_create_from_format('d/m/Y g:iA', $date); 
        $dateTime9 = date_timezone_set($dateTime7, new DateTimeZone('Asia/Kolkata'));
        $dateTime10 = date_timezone_get($dateTime9);

            echo "<pre>";            
                print_r($dateTime7);            
                print_r($dateTime8);
                print_r($dateTime9);
                print_r($dateTime10);
            echo "</pre>";
        

        // date comparison
        $date1 = new DateTime('5/12/2022 22:16');
        $date2 = new DateTime('4/8/2020 22:15');

            var_dump($date1 < $date2); // false
            var_dump($date1 > $date2); // true
            var_dump($date1 == $date2); // false
            var_dump($date1 <=> $date2); // 1       1 0 -1        
            echo "Difference between dates (days): " . $date2->diff($date1)->days . "<br>"; 
            echo "Difference between dates (days format): " . $date2->diff($date1)->format('%a') . "<br>"; 
            echo "Difference between dates (days with sign): " . $date2->diff($date1)->format('%R%a') . "<br>"; 
            echo "Difference between dates (months, days, years, hours, minutes, seconds): " . $date2->diff($date1)->format('%d, %m, %Y, %H, %i, %s');


        // date & time operations and interval
        $date3 = new DateTime('5/25/2022 9:15 AM');        
        $interval = new DateInterval('P3M2D'); // 3 months, 2 days
        // $interval->invert = 1;              // inverts subtraction and addition
        
        $date3->add($interval);
        echo "<br>" . $date3->format('d/m/Y g:iA') . "<br>"; 
        
        $interval1 = new DateInterval('P6M2D'); 
        $date3->sub($interval1);
        echo $date3->format('d/m/Y g:iA'); 
        
        
        // from - to
        // option 1 below does not work as expected; it affects the original object (point to the same memory 
        // location), although assigned to a new variable; use option 2 or 3 or immutable objects
        
        $from = new DateTime();
        // $to = $from->add(new DateInterval('P1M'));               // option 1
        // $to = (new DateTime())->add(new DateInterval('P1M'));    // option 2
        $to = (clone $from)->add(new DateInterval('P1M'));          // option 3
        echo "<br>From " . $from->format('d/m/Y') . " - " . $to->format('d/m/Y') . "<br>";

        $from1 = new DateTimeImmutable(); 
        $to1 = $from1->add(new DateInterval('P3M')); // once assigned value cannot be changed anymore (see line below)
        $to1->add(new DateInterval('P1Y')); // this line will be ignored         
        echo "<br>From " . $from1->format('d/m/Y') . " - " . $to1->format('d/m/Y') . "<br>";
        
        $x = $to1->add(new DateInterval('P1Y')); // however, it can be re-assigned to another variable and modified
        echo "Immutable re-assigned: " . $x->format('d/m/Y');
        

        // period
        //$period = new DatePeriod(new DateTime('05/03/2022'), new DateInterval('P3D'), (new DateTime('05/10/2022'))->modify('+1 day'));

        $period = new DatePeriod(new DateTime('05/03/2022'), new DateInterval('P3D'), 3, DatePeriod::EXCLUDE_START_DATE); // number of recurences as the 3rd parameter

        foreach($period as $date){
            echo "<br>" . $date->format('d/m/Y') . "<br>";
        }
    ?>
    
</body>
</html>