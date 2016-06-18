<?php

$newline = "</br>";
$technology = array('JavaScript','PHP','Swift','Objective C','Java', 'C#' ,'Ruby');

echo 'size($technology) :: '.count($technology).$newline;
echo 'empty($technology) :: ';
var_dump(empty($technology)).$newline;

echo $newline;
echo 'foreach ($technology as $key => $value)'.$newline;

foreach ($technology as $key => $value) {
	echo "Hello $key is $value".$newline;
}

echo $newline;
echo 'foreach ($technology as $tech)'.$newline;

foreach ($technology as $tech) {
	echo "Hi $tech".$newline;
}


echo 'in_array("PHP",$technology) :: ';

echo (in_array("PHP",$technology) ? 'Got PHP' : 'Nope').$newline;

echo 'Filtered javascript, java :: ';

$filterItem = 'JavaScript Java';
$result = array_filter($technology, function($tech) use($filterItem){
	return strpos(strtolower($filterItem), strtolower($tech)) === false;
}
);

print_r($result);
$result[6]="New Ruby";
print_r($result);

?>  
