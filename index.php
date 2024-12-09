<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <title>PHP Advanced Task 2</title>
</head>

<body>
  <div class="container">

    <section class="email-form">
      <!-- Form to collect user email input -->
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="email" name="email" id="email" placeholder="Enter Your Email" required>
        <input type="submit" name="submit" value="Submit">
      </form>

      <!-- Include the form handling PHP script -->
      <?php require 'form.php' ?>
    </section>
  </div>

</body>

</html>
