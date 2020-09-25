<?php

# Join array elements with a string:
$arr = array('Hello','World!','Beautiful','Day!');
echo implode(" ",$arr);
# Hello World! Beautiful Day!


# Convert a string in to an array

$str = "Hello world. It's a beautiful day.";
print_r (explode(" ",$str));
# Array ( [0] => Hello [1] => world. [2] => It's [3] => a [4] => beautiful [5] => day. )


# Search an array for the value "red" and return its key:

$a=array("a"=>"red","b"=>"green","c"=>"blue");
echo array_search("red",$a);
# a


# 
# Search for the value "Glenn" in an array and output some text:

$people = array("Peter", "Joe", "Glenn", "Cleveland");

if (in_array("Glenn", $people))
{ echo "Match found"; } else { echo "Match not found"; }


# Insert "blue" and "yellow" to the end of an array:

$a=array("red","green");
array_push($a,"blue","yellow");
print_r($a);
#Array ( [0] => red [1] => green [2] => blue [3] => yellow )



#
#The last post on the devshed forum topic, it says you can use array_merge to do what your looking for.
$first_array = array(
     'name1' => 'value1',
     'name2' => 'value2',
);
$second_array = array('name3'=>'value3');
$result = array_merge((array)$first_array, (array)$second_array);
print_r($result); 
#Array ( [name1] => value1 [name2] => value2 [name3] => value3 )



# Number formate of decimal number

$number = 1234.56;

// english notation (default)
$english_format_number = number_format($number);
// 1,235

// French notation
$nombre_format_francais = number_format($number, 2, ',', ' ');
// 1 234,56

$number = 1234.5678;

// english notation without thousands separator
$english_format_number = number_format($number, 2, '.', '');
// 1234.57
