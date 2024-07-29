<?php
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $currentDate = date('Y-m-d');

    // Check if the user has already voted today
    $stmt = $conn->prepare("SELECT * FROM votes WHERE ip_address = ? AND vote_date = ?");
    $stmt->bind_param('ss', $ipAddress, $currentDate);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "You have already voted today.";
    } else {
        // Insert votes for each candidate
        $stmt = $conn->prepare("INSERT INTO votes (candidate_id, factor, ip_address, vote_date) VALUES (?, ?, ?, ?)");
        foreach ($_POST['candidate'] as $factor => $candidateId) {
            if (!empty($candidateId)) {
                $stmt->bind_param('isss', $candidateId, $factor, $ipAddress, $currentDate);
                if (!$stmt->execute()) {
                    echo "Error: " . $stmt->error;
                }
            }
        }
        echo "Thank you for your vote!";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Result</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <a href="result.php">View Results</a>
    </div>
    <script src="js/script.js"></script>
</body>

</html>