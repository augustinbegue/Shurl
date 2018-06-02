<?php
htmlspecialchars($_GET['redirectionToken']);

//Checking token exists
$qry = $bdd->prepare('SELECT url FROM shortenedurls WHERE token = :token');
$qry->bindparam(':token', $_GET['redirectionToken']);
$qry->execute();
$response = $qry->fetch();
$qry->closecursor();

//If token exists
if ($response) {

  $redirectUrl = $response['url'];

  //Redirection
  header('Location: '.$redirectUrl);
  exit();

//If token doesn't exists
} elseif (!$response) {
  header('Location: /');
  exit();
}
 ?>
