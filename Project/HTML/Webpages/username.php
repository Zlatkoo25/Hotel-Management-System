<?php
                $e = strtoupper($_SESSION['email']); //uppercased and stored
                $position = strpos($e,"@"); //locates @
                $username = substr($e,0,$position); //subtracts beyond @
                echo "<p style=\"font-family: Arial, sans-serif;\">Hello, $username </p>";

/*Gets username from email by taking characters before "@" might be unnecessarily convoluted; 
might remove in the end.
*/