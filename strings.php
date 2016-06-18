<?php

$engineer = 'not a engineer';
$newline = "<br>";

print 'I\'m a software $engineer'.$newline;
print "I\'m a software $engineer".$newline;


$lorem = "lorem ipsum";
$Lorem = "Lorem ipsum";

echo "substr($lorem,2,2) : ".substr($lorem,2,2).$newline;
echo "strpos($lorem,'ip') : ".strpos($lorem,'ip').$newline;
echo "strpos($lorem,'xx') : ".strpos($lorem,'xx').$newline;

echo 'strpos($lorem,"xx")? "TRUE":"FALSE" :: '.strpos($lorem,'xx')? "TRUE":"FALSE".$newline;

echo "Hey ".(stripos($lorem,'Lo') === false) ? "true" : "false".$newline;

$strreplace = "hello world";
$result = str_replace("hello", "hi", $strreplace);

echo "str_replace($strreplace, 'hello') : ".$result.$newline;

echo " strtolower($Lorem) : ".strtolower($Lorem).$newline;
echo " strtoupper($Lorem) : ".strtoupper($Lorem).$newline;


?>  
