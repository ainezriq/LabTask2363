<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
    <title>Klinik Ajwa</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
</head>
<body>

<?php
//call file to connect to server
include ("header.php");

//this query inserts a record in the clinic table
//has form been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $error = array (); //initialize an error array

    //check for the first name
    if (empty($_POST['FirstName'])) {
        $error[] = 'You forgot to enter your first name.' ;
    } else {
        $n = mysqli_real_escape_string($connect, trim($_POST['FirstName']));
    }

    //check for the last name
    if (empty($_POST['LastName'])) {
        $error[] = 'You forgot to enter your last name.' ;
    } else {
        $l = mysqli_real_escape_string($connect, trim($_POST['LastName']));
    }

    //check for the specialization
    if (empty($_POST['Specialization'])) {
        $error[] = 'You forgot to enter your specialization.' ;
    } else {
        $s = mysqli_real_escape_string($connect, trim($_POST['Specialization']));
    }

    //check for the password
    if (empty($_POST['Password'])) {
        $error[] = 'You forgot to enter your password.' ;
    } else {
        $p = mysqli_real_escape_string($connect, trim($_POST['Password']));
    }

    //register the user in the database
    //make the query
    $q = "INSERT INTO doktor (ID, FirstName, LastName, Specialization, Password)
          VALUES (' ', '$n', '$l', '$s', '$p')";
    $result = @mysqli_query($connect, $q); //run the query
    if ($result) {  //if it runs
        echo '<h1>Thank you</h1>';
        exit();
    } else {  //if it did not run
        //message
        echo '<h1>System error</h1>';

        //debugging message
        echo '<p>' . mysqli_error($connect) . '<br><br>Query: ' . $q . '</p>';
    } // end of if ($result)

    mysqli_close($connect); //close the database connection
    exit();
} //end of main submit conditional
?>

<h2> Register Doktor </h2>
<h4> * required field </h4>
<form action="registerDoktor.php" method="post">

<p><label class="label" for="FirstName">First Name: *</label>
<input id="FirstName" type="text" name="FirstName" size="30" maxlength="150"
value="<?php if (isset($_POST['FirstName'])) echo $_POST['FirstName']; ?>" ></p>

<p><label class="label" for="LastName">Last Name: *</label>
<input id="LastName" type="text" name="LastName" size="30" maxlength="60"
value="<?php if (isset($_POST['LastName'])) echo $_POST['LastName']; ?>" ></p>

<p><label class="label" for="Specialization">Specialization: *</label>
<input id="Specialization" type="text" name="Specialization" size="12" maxlength="12"
value="<?php if (isset($_POST['Specialization'])) echo $_POST['Specialization']; ?>" ></p>

<p><label class="label" for="Password">Password: *</label>
<input id="Password" type="text" name="Password" size="12" maxlength="12"
value="<?php if (isset($_POST['Password'])) echo $_POST['Password']; ?>" ></p>

<p><input id="submit" type="submit" name="submit" value="Register" /> &nbsp;&nbsp;
<input id="reset" type="reset" name="reset" value="Clear All" />
</p>
</form>

<br /><br /><br />

</body>
</html>
