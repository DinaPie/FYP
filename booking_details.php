<?php

include 'db.php';

$start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
$date_input = $_POST['start_date'];

$sql = "SELECT duration FROM packages";
$result = mysqli_query($conn, $sql);

if ($result && $row = mysqli_fetch_assoc($result)) {
    $duration = intval($row['duration']);

    // Convert date string to a DateTime object
    $date = new DateTime($date_input);

    // Add the integer value to the date
    $result_date = $date->add(new DateInterval('P' . $duration . 'D'));

    // Format the result date
    $end_date = $result_date->format('m-d-Y');
} else {
    echo "Error fetching integer value from the database.";
}

$adult = mysqli_real_escape_string($conn, $_POST['adult']);
$child = mysqli_real_escape_string($conn, $_POST['child']);
$infant = mysqli_real_escape_string($conn, $_POST['infant']);

$fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$ic = mysqli_real_escape_string($conn, $_POST['ic']);
$passport = mysqli_real_escape_string($conn, $_POST['passport']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);

$querySchedules = "INSERT INTO schedules (start_date, end_date) VALUES ('$start_date', '$end_date')";
$resultSchedules = mysqli_query($conn, $querySchedules);

$queryBooking = "INSERT INTO booking (adult, child, infant) VALUES ('$adult', '$child', '$infant')";
$resultBooking = mysqli_query($conn, $queryBooking);

$queryParticipants = "INSERT INTO participants (fullName, gender, ic, passport, address, email, phone) VALUES ('$fullName', '$gender', '$ic', '$passport', '$address', '$email', '$phone')";
$resultParticipants = mysqli_query($conn, $queryParticipants);

if ($resultSchedules && $resultBooking && $resultParticipants) {
    echo '<script>alert("Form submitted!");</script>';
    header("location: my_booking.html");
} else {
    echo "Error: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
