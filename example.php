<?php
include("../vendor/autoload.php");

$phpvoat = new \Devsi\PhpVoat\PhpVoat();

$comment = $phpvoat->comment()->getSingleComment(10);

echo $comment->postedBy;
echo "<br />";
echo $comment->content;

echo "<br /><br />";
print_r($comment);