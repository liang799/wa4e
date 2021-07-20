<?php

$failure = false;  // If we have no POST data
$msg = false;

// Demand a GET parameter
if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}

// If the user requested logout go back to index.php
if ( isset($_POST['Logout']) ) {
    header('Location: index.php');
    return;
}

require_once "pdo.php";

if ( isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mil'])) {
    if ( !is_numeric($_POST['mil']) || !is_numeric($_POST['year']) )
        $failure= "Mileage and year must be numeric";
    elseif ( strlen($_POST['make']) < 1 )
        $failure= 'Make is required';
    else{
        $sql = "INSERT INTO autos (make, year, mileage)
                VALUES (:make, :y, :m)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':make' => $_POST['make'],
            ':y' => $_POST['year'],
            ':m' => $_POST['mil']));
        $msg='Record inserted';
    }
}
$stmt = $pdo->query("SELECT make,year,mileage FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<html>
    <head>
        <title>My Automobile Tracker</title>
    </head>

    <body>
        <h1>Tracking autos for <?php echo( htmlentities($_GET['name']) ) ?></h1>

        <?php
        // Note triple not equals and think how badly double
        // not equals would work here...
        if ( $failure !== false ) {
            // Look closely at the use of single and double quotes
            echo('<p style="color: red">'.htmlentities($failure)."</p>");
        }

        if ( $msg !== false ){
            echo('<p style ="color: green">'.htmlentities($msg).'</p>');
        }
        ?>

        <form method='POST'>
            <label for ='make'>Make:</label>
            <input type ='text' id ='make' name ='make'>
            <br>
            <label for ='year'>Year:</label>
            <input type ='text' id='year' name='year'>
            <br>
            <label for ='mil'>Mileage:</label>
            <input type ='text' id='mil' name='mil'>
            <br>
            <input type="submit" name ="Add" value="Add">
            <input type="submit" name="Logout" value='Logout'>
        </form>

        <h2>Automobiles</h2>
        <?php
        foreach ( $rows as $row ){
            echo "<li>";
            echo( htmlentities($row['year']) . " " . htmlentities($row['make']) . " / " . htmlentities($row['mileage']) );
            echo "</li>";
        }
        ?>
        </ul>


    </body>
