<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Klinik Ajwa</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
// call file to connect server
include ("header.php");

//This query inserts a record in the clinic table
//has form been submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = array(); //initialize an error array

    //check for firstname
    if (empty($_POST['FirstName_P'])) {
        $error[] = 'You forgot to enter your First Name.';
    } else {
        $n = mysqli_real_escape_string($connect, trim($_POST['FirstName_P']));
    }

    //check for lastname
    if (empty($_POST['LastName_P'])) {
        $error[] = 'You forgot to enter your Last Name.';
    } else {
        $l = mysqli_real_escape_string($connect, trim($_POST['LastName_P']));
    }

    //check for insurance number (assumed correct column name is InsuranceNumber)
    if (empty($_POST['InsuranceNumber'])) {
        $error[] = 'You forgot to enter your Insurance Number.';
    } else {
        $i = mysqli_real_escape_string($connect, trim($_POST['InsuranceNumber']));
    }

    //check for diagnose
    if (empty($_POST['Diagnose'])) {
        $error[] = 'You forgot to enter your Diagnose.';
    } else {
        $d = mysqli_real_escape_string($connect, trim($_POST['Diagnose']));
    }

    //register the user in the database
    if (empty($error)) { // No errors, proceed with query
        //make the query (update column name for InsuranceNumber)
       $q = "INSERT INTO pesakit (FirstName_P, LastName_P, InsuranceNumber, Diagnose)
      VALUES ('$n', '$l', '$i', '$d')";
        $result = @mysqli_query($connect, $q); //run the query

        if ($result) { //if it runs
            echo '<h1>Thank you. The patient has been registered.</h1>';
            exit();
        } else { //if it didn't run
            echo '<h1>System error</h1>';
            //debugging message
            echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
        }
    } else {
        // Report any errors
        echo '<p class="error">The following errors occurred:<br>';
        foreach ($error as $msg) {
            echo " - $msg<br>\n";
        }
        echo '</p><p>Please try again.</p>';
    }

    mysqli_close($connect); //close the database connection
    exit();
} //end of the main submit conditional
?>

<h2>Register</h2>
<h4>* required field</h4>
<form action="register.php" method="post">

    <p><label class="label" for="FirstName_P">First Name:</label>
    <input id="FirstName_P" type="text" name="FirstName_P" size="30" maxlength="150"
           value="<?php if (isset($_POST['FirstName_P'])) echo $_POST['FirstName_P']; ?>"></p>

    <p><label class="label" for="LastName_P">Last Name:</label>
    <input id="LastName_P" type="text" name="LastName_P" size="30" maxlength="60"
           value="<?php if (isset($_POST['LastName_P'])) echo $_POST['LastName_P']; ?>"></p>

    <p><label class="label" for="InsuranceNumber">Insurance Number:</label>
    <input id="InsuranceNumber" type="text" name="InsuranceNumber" size="12" maxlength="12"
           value="<?php if (isset($_POST['InsuranceNumber'])) echo $_POST['InsuranceNumber']; ?>"></p>

    <p><label class="label" for="Diagnose">Diagnose:</label></p>
    <textarea name="Diagnose" rows="5" cols="40"><?php if (isset($_POST['Diagnose'])) echo $_POST['Diagnose']; ?></textarea>

    <p><input id="submit" type="submit" name="submit" value="Register">&nbsp;&nbsp;
    <input id="reset" type="reset" name="reset" value="Clear All"></p>

</form>
<br />
<br />
<br />
</body>
</html>
