<!doctype HTML>
<html>

<head>
    <title> Tian Pok's guessing game </title>
</head>

<body>
    <h1> Welcome to my guessing game </h1>

    <h3> Insert your answer in the box below: </h3>

    <form>
        <input type="text" name="guess" size="60" />
        <input type="submit" value="Go"/>
    </form>

    <br>

    <em style = 'color: red'>Notification:</em>

    <p>
        <?php

            $sol = 10;
            $guess = $_GET["guess"];

            if ( isset($guess) === FALSE ) // isset checks whether a variable is empty
                    echo("Missing guess parameter");
            else if ( strlen($guess) < 1 )
                    echo("Your guess is too short");
            elseif ( is_numeric($guess) === FALSE )
                    echo "Your guess is not a number";
            elseif ( $guess > $sol )
                    echo 'Your guess is too high';
            elseif ( $guess < $sol )
                    echo 'Your guess is too low';
            else
                    echo 'Congratulations - You are right!';

            ?>
    </p>


    <br>

    <em style = 'color: red'>Solution:</em>
    <p>
        Stuck? Click <a herf = "guess.php?guess=10">here</a> to reveal the answer.
    </p>
</body>

</html>
