var points = new Array(40, 100, 1, 5, 25, 10); // Bad
var points = [40, 100, 1, 5, 25, 10];          // Good

var fruits = ["Banana", "Orange", "Apple", "Mango"];
fruits.push("Lemon");    // adds a new element (Lemon) to fruits

var fruits = ["Banana", "Orange", "Apple", "Mango"];
fruits[6] = "Lemon";    // adds a new element (Lemon) to fruits


var salary = [
   ["ABC", 24, 18000],
   ["EFG", 30, 30000],
   ["IJK", 28, 41000],
   ["EFG", 31, 28000],
];


var categories = [
    {"1":"Category 1"},
    {"2":"Category 2"},
    {"3":"Category 3"},
    {"4":"Category 4"}
];
Push items to the array:

categories.push({"2300": "Category 2300"});
categories.push({"2301": "Category 2301"});