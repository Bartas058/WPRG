<?php

$fruits = array("jablko", "banan", "pomarancza");

foreach ($fruits as $fruit) {
    $length = strlen($fruit);
    for ($i = $length - 1; $i >= 0; $i--) {
        echo $fruit[$i];
    }
    
    if ($fruit[0] == 'p' || $fruit[0] == 'P') {
        echo " - begins with the letter 'p'!\n";
    } else {
        echo " - does not begin with the letter 'p'!\n";
    }
}

?>