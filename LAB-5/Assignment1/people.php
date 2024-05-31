<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num_people = $_SESSION['num_people'];
    for ($i = 1; $i <= $num_people; $i++) {
        $_SESSION["person_$i"] = [
            'name' => $_POST["name_$i"],
            'age' => $_POST["age_$i"]
        ];
    }
    header('Location: summary.php');
    exit();
}

$num_people = isset($_SESSION['num_people']) ? $_SESSION['num_people'] : 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reservation Step 2</title>
</head>
<body>
<h1>Step 2: People Information</h1>
<form method="post" action="people.php">
    <?php for ($i = 1; $i <= $num_people; $i++): ?>
        <fieldset>
            <legend>Person <?php echo $i; ?></legend>
            <label for="name_<?php echo $i; ?>">Name:</label>
            <input type="text" id="name_<?php echo $i; ?>" name="name_<?php echo $i; ?>" required><br>

            <label for="age_<?php echo $i; ?>">Age:</label>
            <input type="number" id="age_<?php echo $i; ?>" name="age_<?php echo $i; ?>" required><br>
        </fieldset>
    <?php endfor; ?>
    <input type="submit" value="Next">
</form>
</body>
</html>