
<?php

$fh = fopen('C:\xampp\apache\logs\access.log', 'r');
while (true) {
    $line = fgets($fh);
    if ($line !== false) {
      // show the line or send it via email or to a websocket..
      echo $line.'<br>';
    } else {
        // sleep for 0.1 seconds (or more?)
        usleep(0.1 * 1000000);
        fseek($fh, ftell($fh));
    }
}
