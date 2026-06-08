<?php

//variables initialize 
$fname = $mname = $lname = $city = $email = $contact = "";
$gender = $adhar = $pan = $username = $password = $confirm = "";

//error variable initialize
$fnameErr = $mnameErr = $lnameErr = $cityErr = $emailErr = $contactErr = "";
$genderErr = $adharErr = $panErr = $usernameErr = $passwordErr = $confirmErr = "";
$successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    // name validation
    if (empty($_POST["fname"])) {
        $fnameErr = "First name is required";
        $valid = false;
    } else {
        $fname = trim($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z ]+$/", $fname)) {
            $fnameErr = "Only letters and spaces allowed";
            $valid = false;
        }
    }

    // middle name validation
    if (empty($_POST["mname"])) {
        $mnameErr = "Middle name is required";
        $valid = false;
    } else {
        $mname = trim($_POST["mname"]);
        if (!preg_match("/^[a-zA-Z ]+$/", $mname)) {
            $mnameErr = "Only letters and spaces allowed";
            $valid = false;
        }
    }

    // last name validation
    if (empty($_POST["lname"])) {
        $lnameErr = "Last name is required";
        $valid = false;
    } else {
        $lname = trim($_POST["lname"]);
        if (!preg_match("/^[a-zA-Z ]+$/", $lname)) {
            $lnameErr = "Only letters and spaces allowed";
            $valid = false;
        }
    }

    // city validation
    if (empty($_POST["city"])) {
        $cityErr = "City is required";
        $valid = false;
    } else {
        $city = trim($_POST["city"]);
        if (!preg_match("/^[a-zA-Z ]+$/", $city)) {
            $cityErr = "Only letters and spaces allowed";
            $valid = false;
        }
    }

    // email validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $valid = false;
    } else {
        $email = trim($_POST["email"]);
        if (!preg_match("/^[\w\.-]+@[\w\.-]+\.\w+$/", $email)) {
            $emailErr = "Invalid email format";
            $valid = false;
        }
    }

    // number validation
    if (empty($_POST["contact"])) {
        $contactErr = "Contact number is required";
        $valid = false;
    } else {
        $contact = trim($_POST["contact"]);
        if (!preg_match("/^[6-9][0-9]{9}$/", $contact)) {
            $contactErr = "Invalid Indian mobile number";
            $valid = false;
        }
    }

    // gender validation
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
        $valid = false;
    } else {
        $gender = $_POST["gender"];
    }

    // Aadhar validation 
    if (empty($_POST["adhar"])) {
        $adharErr = "Aadhar Number is required";
        $valid = false;
    } else {
        $adhar = trim($_POST["adhar"]);
        if (!preg_match("/^[0-9]{12}$/", $adhar)) {
            $adharErr = "Aadhar must be exactly 12 digits";
            $valid = false;
        }
    }

    // PAN card validation
    if (empty($_POST["pan"])) {
        $panErr = "PAN Number is required";
        $valid = false;
    } else {
        $pan = strtoupper(trim($_POST["pan"]));
        if (!preg_match("/^[A-Z]{5}[0-9]{4}[A-Z]$/", $pan)) {
            $panErr = "Invalid PAN Number format";
            $valid = false;
        }
    }

    // Username validation
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
        $valid = false;
    } else {
        $username = trim($_POST["username"]);
        // Alpha-numeric, 5 to 15 chars
        if (!preg_match("/^[a-zA-Z0-9_]{5,15}$/", $username)) {
            $usernameErr = "5-15 letters, numbers, or underscores only";
            $valid = false;
        }
    }

    // Strong password validation
    if (empty($_POST["password"])) {
        $passwordError = "Password is required";
        $valid = false;
    } else {
        $password = $_POST["password"];
        $pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/";
        if (!preg_match($pattern, $password)) {
            $passwordError = "Must contain uppercase, lowercase, number, special char, and 8+ chars.";
            $valid = false;
        }
    }

    // Confirm password
    if (empty($_POST["confirm"])) {
        $confirmErr = "Please confirm password";
        $valid = false;
    } else {
        $confirm = $_POST["confirm"];
        if ($password !== $confirm) {
            $confirmErr = "Passwords do not match";
            $valid = false;
        }
    }

    // Success message
    if ($valid) {
        $successMsg = "Registration Successful! Thank you, $fname.";
        $fname = $mname = $lname = $city = $email = $contact = "";
        $gender = $adhar = $pan = $username = "";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f5;
            margin: 0;
            padding: 40px;
        }
        .form-wrapper {
            max-width: 700px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }
        input[type=text], input[type=password], input[type=email] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .radio-group {
            padding: 5px 0;
        }
        .error {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }
        .success {
            color: #27ae60;
            background: #eafaf1;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }
        input[type=submit] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type=submit]:hover {
            background-color: #0056b3;
        }
        .row {
            display: flex;
            gap: 15px;
        }
        .col {
            flex: 1;
        }
    </style>
</head>
<body>

<div class="form-wrapper">
    <h2>Student Registration Form</h2>

    <?php if(!empty($successMsg)) { ?>
        <div class="success"><?php echo $successMsg; ?></div>
    <?php } ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
        <div class="row">
            <div class="form-group col">
                <label>First Name</label>
                <input type="text" name="fname" value="<?php echo htmlspecialchars($fname); ?>">
                <span class="error"><?php echo $fnameErr; ?></span>
            </div>
            <div class="form-group col">
                <label>Middle Name</label>
                <input type="text" name="mname" value="<?php echo htmlspecialchars($mname); ?>">
                <span class="error"><?php echo $mnameErr; ?></span>
            </div>
            <div class="form-group col">
                <label>Last Name</label>
                <input type="text" name="lname" value="<?php echo htmlspecialchars($lname); ?>">
                <span class="error"><?php echo $lnameErr; ?></span>
            </div>
        </div>

        <div class="row">
            <div class="form-group col">
                <label>Email Address</label>
                <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <span class="error"><?php echo $emailErr; ?></span>
            </div>
            <div class="form-group col">
                <label>Contact Number</label>
                <input type="text" name="contact" maxlength="10" value="<?php echo htmlspecialchars($contact); ?>">
                <span class="error"><?php echo $contactErr; ?></span>
            </div>
        </div>

        <div class="row">
            <div class="form-group col">
                <label>City</label>
                <input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>">
                <span class="error"><?php echo $cityErr; ?></span>
            </div>
            <div class="form-group col">
                <label>Gender</label>
                <div class="radio-group">
                    <input type="radio" name="gender" value="Male" <?php if($gender=="Male") echo "checked";?>> Male
                    <input type="radio" name="gender" value="Female" <?php if($gender=="Female") echo "checked";?>> Female
                </div>
                <span class="error"><?php echo $genderErr; ?></span>
            </div>
        </div>

        <div class="row">
            <div class="form-group col">
                <label>Aadhar Number</label>
                <input type="text" name="adhar" maxlength="12" value="<?php echo htmlspecialchars($adhar); ?>">
                <span class="error"><?php echo $adharErr; ?></span>
            </div>
            <div class="form-group col">
                <label>PAN Number</label>
                <input type="text" name="pan" maxlength="10" style="text-transform:uppercase;" value="<?php echo htmlspecialchars($pan); ?>">
                <span class="error"><?php echo $panErr; ?></span>
            </div>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
            <span class="error"><?php echo $usernameErr; ?></span>
        </div>

        <div class="row">
            <div class="form-group col">
                <label>Password</label>
                <input type="password" name="password">
                <span class="error"><?php echo $passwordError; ?></span>
            </div>
            <div class="form-group col">
                <label>Confirm Password</label>
                <input type="password" name="confirm">
                <span class="error"><?php echo $confirmErr; ?></span>
            </div>
        </div>

        <input type="submit" value="Register Now">
    </form>
</div>

</body>
</html>