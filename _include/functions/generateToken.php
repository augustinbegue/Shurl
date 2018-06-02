<?php
function generateToken($tokenLength)
{
  require '_include\bdd\connect.php';

  $tkn = null;
  $generatedToken = null;

  while ($tkn === $generatedToken) {

    //Generating token
    $bytes = random_bytes($tokenLength);
    $generatedToken = bin2hex($bytes);

    //Checking if token already exists
    $qry = $bdd->prepare('SELECT id FROM shortenedurls WHERE token = :token;');
    $qry->bindparam(':token', $generatedToken);
    $qry->execute();
    $tkn = $qry->fetch();
    $qry->closecursor();
  }

  return $generatedToken;
}
 ?>
