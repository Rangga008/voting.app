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

function getCandidates($criteria, $conn) {
    $gender = $criteria['gender'];
    $type = $criteria['type'];
    
    $query = "SELECT * FROM candidates WHERE 1=1";
    if ($gender) {
        $query .= " AND gender = '$gender'";
    }
    if ($type) {
        $query .= " AND type = '$type'";
    }
    $query .= " ORDER BY name ASC";
    
    return $conn->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting App</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
    .photo-container {
        z-index: 0;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        display: none;

    }

    .photo-left {
        left: 0;
    }

    .photo-right {
        right: 0;
    }

    .photo-container img {
        z-index: 0;
        max-width: 200px;
        max-height: 200px;
    }

    .logo {
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Vote for the Best Member and PI</h1>
        <p>Choose your favorite:</p>
        <div class="photo-container photo-left" style="z-index: 0;">
            <img src="images/Osis_Bareng.jpg" alt="Photo 1">
        </div>
        <div class="form-container">
            <form action="vote.php" method="POST">
                <?php foreach ($factors as $factor => $criteria): ?>
                <div class="form-group">
                    <label for="factor<?php echo $factor; ?>"><?php echo ucfirst($factor); ?>:</label>
                    <select id="factor<?php echo $factor; ?>" name="candidate[<?php echo $factor; ?>]"
                        class="factor-select">
                        <option value="">Select Candidate</option>
                        <?php 
                            $candidates = getCandidates($criteria, $conn);
                            while ($candidate = $candidates->fetch_assoc()): ?>
                        <option value="<?php echo $candidate['id']; ?>"><?php echo $candidate['name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <?php endforeach; ?>
                <button type="submit">Vote</button>
            </form>
        </div>

        <div class="photo-container photo-right" style="z-index: 0;">
            <img src="images/Mpk_Bareng.jpg" alt="Photo 2">
        </div>
        <div class="logo">
            <img src="images/osis.png" alt="Logo Sekolah" />
            <img src="images/smk2.png" alt="Logo Sekolah" />
            <img src="images/mpk.png" alt="Logo Sekolah" />
        </div>
        <script src="js/script.js"></script>
</body>

</html>