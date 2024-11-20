<?php
session_start();
include 'CONFIG1.PHP';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input to prevent SQL injection and XSS attacks
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $fathers_name = mysqli_real_escape_string($conn, $_POST['fathers_name']);
    $mothers_name = mysqli_real_escape_string($conn, $_POST['mothers_name']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $birth_date = mysqli_real_escape_string($conn, $_POST['birth_date']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $institute = mysqli_real_escape_string($conn, $_POST['institute']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Prepare the SQL insert query
    $sql = "INSERT INTO registration (full_name, fathers_name, mothers_name, phone_number, birth_date, gender, institute, semester, password) 
            VALUES ('$full_name', '$fathers_name', '$mothers_name', '$phone_number', '$birth_date', '$gender', '$institute', '$semester', '$password')";

    // Execute the query and check if it's successful
    if ($conn->query($sql) === TRUE) {
        $_SESSION['full_name'] = $full_name;  // Store the name in session if needed
        header("Location: thankyou.html");  // Redirect to a thank you page on success
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;  // Display error if query fails
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/WD/MP/registration.css" />
    <title>Registration Form</title>
</head>
<body>
    <section class="container">
        <header><b><u>Registration Form</u></b></header>
        <form action="REGISTER1.PHP" method="post" class="form">
            <div class="input-box">
                <input type="text" name="full_name" placeholder="Enter full name" required />
            </div>
            <div class="input-box">
                <input type="text" name="fathers_name" placeholder="Enter father's name" required />
            </div>
            <div class="input-box">
                <input type="text" name="mothers_name" placeholder="Enter mother's name" required />
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Enter your password" required />
            </div>
            <div class="column">
                <div class="input-box">
                    <input type="number" name="phone_number" placeholder="Enter phone number" required />
                </div>
                <div class="input-box">
                    <input type="date" name="birth_date" required />
                </div>
            </div>
            <div class="gender-box">
                <h3>Gender</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="check-male" name="gender" value="Male" checked />
                        <label for="check-male">Male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-female" name="gender" value="Female" />
                        <label for="check-female">Female</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-other" name="gender" value="Other" />
                        <label for="check-other">Prefer not to say</label>
                    </div>
                </div>
            </div>
            <div class="select-box">
                <select name="institute" required>
                    <option hidden>INSTITUTE</option>
                    <option value="KGP">KGP</option>
                    <option value="SSM">SSM</option>
                    <option value="JAMMU POLYTECHNIC">JAMMU POLYTECHNIC</option>
                    <option value="WPS">WPS</option>
                </select>
            </div>
            <div class="select-box">
                <select name="semester" required>
                    <option hidden>SEMESTER</option>
                    <option value="I">I</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                    <option value="IV">IV</option>
                    <option value="V">V</option>
                    <option value="VI">VI</option>
                </select>
            </div>
            <button type="submit">Submit</button>
        </form>
    </section>
</body>
</html