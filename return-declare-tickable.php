<?php
/**
 * If strict types declared, loose evaluation will not be possible
 * for example, if a function expects 2 integers, strings like '3' will not be possible to use (autocasting)
 * If a file with strict type declared is included into another file in which strict types are required, 
 * the other file will have to declare strict types as well, otherwise no strict types will be required 
 * However, autocasting will be performed if a function is called from another file 
 * (see return-declare-tickable-2)
 */
declare(strict_types=1);
echo "STRICT TYPES<br>"; 

function sum($x, $y){
    return $x + $y;
}

echo sum(5, 7), "<br>";


/**
 * 3 types of directives: ticks, encoding, strict_types
 * Tick: an event that occurs for tickable low level statements that are executed by the parser
 * Most statements sth. that is called tick, which is kind of an event (not all statements are tickable)
 * There are not too many use case for ticks but it can be used in profiling to see how efficient the code is
 */

echo "TICKS<br>"; 
// the 3 statements below will cause 3 ticks
// $x = 5;
// $y = 3;
// $z = $x + $y; 

/**
 * The tick registering function must be above its registration
 */
function onTick(){
    echo "Tick <br>";
}

/**
 * Number 1 in declare() tells PHP how many tickable statements should pass before it triggers a tick 
 * or an event and before the register function runs
 */
register_tick_function('onTick');
declare(ticks = 3); 

$i = 0;
$length = 10;

while($i < $length){
    echo $i++ . " ";
}


