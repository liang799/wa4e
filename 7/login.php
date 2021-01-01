<?php // Do not put any HTML above this line

if ( isset($_POST['cancel'] ) ) {
    // Redirect the browser to game.php
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123

$failure = false;  // If we have no POST data

// Check to see if we have some POST data, if we do process it
if ( isset($_POST['who']) && isset($_POST['pass']) ) {
    if ( strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1 ) 
        $failure = "User name and password are required";
    //check for vaild email input
        elseif ( (strpos($_POST['who'], '@') === false) )// an alternative would be parse_str ($who, '@')
            $failure = "Email must have an at-sign (@)";

            else {
                $check = hash('md5', $salt.$_POST['pass']);
                if ( $check == $stored_hash ) {
                    // Redirect the browser to game.php
                    header("Location: game.php?name=".urlencode($_POST['who']));
                    return;
                } else {
                    error_log("Login fail ".$_POST['who']." $check");
                    $failure = "Incorrect password";
                }
            }
}

// Fall through into the View
?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once "bootstrap.php"; ?>
    <title>Tian Pok's Login Page</title>
</head>

<body>

    <div class="container">

        <h1>Please Log In</h1>

<?php
// Note triple not equals and think how badly double
// not equals would work here...
if ( $failure !== false ) {
    // Look closely at the use of single and double quotes
    echo('<p style="color: red;">'.htmlentities($failure)."</p>\n");
}
?>
        <form method="POST">
            <label for="nam">Email</label>
            <input type="text" name="who" id="nam"><br/>
            <label for="id_1723">Password</label>
            <input type="text" name="pass" id="id_1723"><br/>
            <input type="submit" value="Log In">
            <input type="submit" name="cancel" value="Cancel">
        </form>

        <p>
            Note: Your implementation should retain data across multiple logout/login sessions.
            This sample implementation clears all its data on logout - which you should not do in your implementation.

            * Please do not use HTML5 in-browser data validation (i.e. type="number") for the fields in this assignment as we want to make sure you can properly do server side data validation. And in general, even when you do client-side data
            validation, you should still validate data on the server in case the user is using a non-HTML5 browser.
        </p>

    </div>
</body>

</html>
