<!DOCTYPE html>
<html>

<head>
    <title>Tian Pok's MD5 Cracker</title>
</head>

 <!-- Note: it is a bad practise to do inline styling -->
<body style ='background : black'>

    <h1 style = 'color : white'>[FOR YOUR EYES ONLY] MD5 cracker</h1>

    <iframe id='ivplayer' width='640' height='360' src='https://invidious.snopyta.org/embed/U9FzgsF2T-s?listen=1' style='border:none;'></iframe>

    <p style = 'color : white'>
        This application takes an MD5 hash of a four digit pin and check all 10,000
        possible four digit PINs to determine the PIN.
    </p>

    <pre style = 'color : red'>
<b>Notification from Agent csev:</b>

This following is a list of people, and their hashed PIN values.

email                pin   hash_pin
-----                ---   --------
csev@umich.edu       ????  0bd65e799153554726820ca639514029
nabgilby@umich.edu   ????  aa36c88c27650af3b9868b723ae15dfc
pconway@umich.edu    ????  1ca906c1ad59db8f11643829560bab55
font@umich.edu       ????  1d8d70dddf147d2d92a634817f01b239
collemc@umich.edu    ????  acf06cdd9c744f969958e1f085554c8b
...

You should be able to easily crack all but one of these these PINs using your application.
    </pre>

    <pre style = 'color : #72ff72'>

Debug Output:

<?php

$goodpin = "Not found"; //change this to $goodpin

// If there is no parameter, this code is all skipped
if ( isset($_GET['md5']) ) {
    $time_pre = microtime(true); //microtime — Return current Unix timestamp with microseconds
    $md5 = $_GET['md5'];

    // This is our alphabet - This screams "CHANGE ME!"
    $num = "0123456789";
    $show = 15;

    // Outer loop go go through the alphabet for the
    // first position in our "possible" pre-hash
    // text
    for($i=0; $i<strlen($num); $i++ ) {
        $no1 = $num[$i];   // The first of two integer

        for($j=0; $j<strlen($num); $j++ ) {
            $no2= $num[$j];   // The second of two integer

            for($k=0; $k<strlen($num); $k++ ) {
                $no3= $num[$k];   // The third of two integer

                // Our inner loop Not the use of new variables
                // $j and $ch2
                for($l=0; $l<strlen($num); $l++ ) {
                    $no4 = $num[$l];  // Our fourth number

                    // Concatenate the integers together to
                    // form the "possible" pre-hash pin
                    $try = $no1.$no2.$no3.$no4;

                    // Run the hash and then check to see if we match
                    $check = hash('md5', $try);
                    if ( $check == $md5 ) {
                        $goodpin = $try;
                        break;   // Exit the inner loop
                    }

                    // Debug output until $show hits 0
                    if ( $show > 0 ) {
                        print "$check $try\n";
                        $show = $show - 1;
                    }
                }
            }
        }
    }

    // Compute elapsed time
    $time_post = microtime(true);
    print "Elapsed time: ";
    print $time_post-$time_pre;
    print "\n";
}

?>
    </pre>

    <!-- Use the very short syntax and call htmlentities() -->
    <p style = 'color : white'>PIN: <?= htmlentities($goodpin); ?></p>

    <form>
        <input type="text" name="md5" size="60">
        <input type="submit" value="Crack MD5">
    </form>

    <ul style = 'white'>
        <li><a href="index.php">Reset</a></li>
        <li><a href="md5.php">MD5 Encoder</a></li>
        <li><a href="makecode.php">MD5 Code Maker</a></li>
        <li><a href="https://github.com/csev/wa4e/tree/master/code/crack"target="_blank">Code used as reference</a></li>
    </ul>


</body>

</html>
