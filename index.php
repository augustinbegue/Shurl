<?php
require '_include\bdd\connect.php';

if (!empty($_GET['redirectionToken'])) {
  require '_include/redirection/redirect.php';
} else {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
      $pageTitle = "Shurl - Shorten urls easily";
      $pageDesc = "Shurl allows you to shorten urls very easily in order to give them a cleaner look and include them in a character limited social network like Twitter.";

      require '_include\head.php';
    ?>
  </head>
  <body>
    <?php
    require '_include\shortener\input.php'; /* Shortener Input */
    require '_include\shortener\shortener.php'; /* Shortener post */
    ?>
  </body>
</html>
<?php
}
 ?>
