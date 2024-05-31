<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reservation Summary</title>
</head>
<body>
<h1>Step 3: Summary</h1>
<h2>General Information</h2>
<p>Card Number: <?php echo $_SESSION['card_number']; ?></p>
<p>Order Name: <?php echo $_SESSION['order_name']; ?></p>
<p>Number of People: <?php echo $_SESSION['num_people']; ?></p>

<h2>People Information</h2>
<?php for ($i = 1; $i <= $_SESSION['num_people']; $i++): ?>
    <h3>Person <?php echo $i; ?></h3>
    <p>Name: <?php echo $_SESSION["person_$i"]['name']; ?></p>
    <p>Age: <?php echo $_SESSION["person_$i"]['age']; ?></p>
<?php endfor; ?>
</body>
</html>