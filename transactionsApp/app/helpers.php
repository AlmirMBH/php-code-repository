<?php

declare(strict_types = 1);


function formatDollarAmount(float $amount): string{
    $isNegative = $amount < 0;

    // abs is used because no negative numbers should be in number_format
    return ($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2);
}


function formatDate(string $date): string{
    return date('M j, Y', strtotime($date));
}