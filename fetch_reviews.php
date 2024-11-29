<?php
include 'login/config.php'; // Include your database connection

// Fetch reviews with user details
$sql = "SELECT reviews.review, user_form.username, user_form.profile_picture
        FROM reviews
        INNER JOIN user_form ON reviews.user_id = user_form.id";
$result = $conn->query($sql);

$reviews = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

$conn->close();

// Encode reviews in JSON format
$reviews_json = json_encode($reviews);
?>
