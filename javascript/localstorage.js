#All documents of localstorage

// https://blog.logrocket.com/the-complete-guide-to-using-localstorage-in-javascript-apps-ba44edb53a36/


window.localStorage.setItem('name', 'Obaseki Nosa');
window.localStorage.getItem('name');
window.localStorage.removeItem('name');
window.localStorage.clear();
var KeyName = window.localStorage.key(index);


// To store arrays or objects, you would have to convert them to strings.

// To do this, we use the JSON.stringify() method before passing to setItem().

const person = {
    name: "Obaseki Nosa",
    location: "Lagos",
}

window.localStorage.setItem('user', JSON.stringify(person));

JSON.parse(window.localStorage.getItem('user'));

// Note


window.localStorage.getItem('user');
// This returns a string with value as:
// “{“name”:”Obaseki Nosa”,”location”:”Lagos”}”


// To use this value, you would have to convert it back to an object.

// To do this, we make use of the JSON.parse() method, which converts a JSON string into a JavaScript object.

JSON.parse(window.localStorage.getItem('user'));