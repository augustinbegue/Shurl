<?php
require '_include\functions\generateToken.php';

if (!empty($_POST['urlToShorten'])) {

  htmlspecialchars($_POST['urlToShorten']);

  //Checking if url has already been shortened
  $qry = $bdd->prepare('SELECT token FROM shortenedurls WHERE url = :url');
  $qry->bindparam(':url', $_POST['urlToShorten']);
  $qry->execute();
  $url = $qry->fetch();
  $qry->closecursor();

  if (!$url) { // Url has never been shortened

    $token = generateToken(2); //Generating new random token

    $qry = $bdd->prepare('INSERT INTO shortenedurls (url, token) VALUES (:url, :token)');
    $qry->bindparam(':url', $_POST['urlToShorten']);
    $qry->bindparam(':token', $token);
    $qry->execute();

    //Generating url
    $shortenedUrl = 'http://localhost/index.php?redirectionToken='.$token;
    $shortenedUrlDisplay = 'shurl.tk/'.$token;

  } else { //Url has already been shortened

    $token = $url['token']; //Setting return token
    //Generating url
    $shortenedUrl = 'http://localhost/index.php?redirectionToken='.$token;
    $shortenedUrlDisplay = 'shurl.tk/'.$token;

  }

  require '_include\shortener\urlDisplay.php'; // Display Shortened Url

} else {
  require '_include\shortener\errorPopup.php';
}
 ?>
