<?php
include 'config/database.php';

$factors = [
    'PK tercantik' => ['gender' => 'Female', 'type' => 'general'],
    'PK terganteng' => ['gender' => 'Male', 'type' => 'general'],
    'PK ter wibawa' => ['gender' => '', 'type' => 'general'],
    'PK ter lucu' => ['gender' => '', 'type' => 'general'],
    'PK ter galak' => ['gender' => '', 'type' => 'general'],
    'PK ter cuek' => ['gender' => '', 'type' => 'general'],
    'PK ter humoris' => ['gender' => '', 'type' => 'general'],
    'PK ter tegas' => ['gender' => '', 'type' => 'general'],
    'PI tercantik' => ['gender' => 'Female', 'type' => 'PI'],
    'PI terganteng' => ['gender' => 'Male', 'type' => 'PI'],
    'PI ter lucu' => ['gender' => '', 'type' => 'PI'],
    'PI ter galak' => ['gender' => '', 'type' => 'PI'],
    'PI ter cuek' => ['gender' => '', 'type' => 'PI'],
    'PI ter humoris' => ['gender' => '', 'type' => 'PI'],
    'PI ter wibawa' => ['gender' => '', 'type' => 'PI'],
    'PI ter tegas' => ['gender' => '', 'type' => 'PI']
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Results</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h1>Vote Results</h1>
        <?php foreach ($factors as $factor => $criteria): ?>
        <h2><?php echo ucfirst($factor); ?></h2>
        <?php
            $results = $conn->query("SELECT candidates.name, COUNT(votes.id) as vote_count 
                                     FROM votes 
                                     JOIN candidates ON votes.candidate_id = candidates.id 
                                     WHERE votes.factor = '$factor' 
                                     GROUP BY candidates.name 
                                     ORDER BY vote_count DESC");
            ?>
        <ul>
            <?php while ($row = $results->fetch_assoc()): ?>
            <li><?php echo $row['name']; ?>: <?php echo $row['vote_count']; ?> votes</li>
            <?php endwhile; ?>
        </ul>
        <?php endforeach; ?>
        <a href="index.php">Back to Voting</a>
    </div>
    <script src="js/script.js"></script>
</body>

</html>