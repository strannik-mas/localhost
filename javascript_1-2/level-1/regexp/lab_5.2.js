/* var pattern = /^\d{1,2}-\d{1,2}-\d{4}$/;

var s1 = "25-02-1987";
var s2 = "25-1-1933";
var s3 = "01-23-1983";
var s4 = "98s84-02-1987";

print(pattern.test(s1));
print(pattern.test(s2));
print(pattern.test(s3));
print(pattern.test(s4));
 */


// print(/b/i.test("QABD"));
// print(/^def/im.test("ABC\nDEF\nJKL"));

/*
"..........."
""
".............'  --- must be error
*/
// var re = /(['"])[^'"]*\1/;


// var str = "12asdWF";
//need asdWF-12
// print(str.replace(/^(\d+)([a-z]+)$/i, "$2-$1"));
/*
var s = "Smith, John\nSow, Mike\nDrian, Stive";
//"John Smith\nMike Sow\nStive Drian"
print(s.replace(/([a-z]+), ([a-z]+)/ig, "$2 $1"));


var stre = "vasya@mail.ru";
print(stre.match(/([a-z]+)@([a-z]+)\.([a-z]{2,})/i));

var email = "s211211@ukr.net";
print(/gmail|yandex|yahoo/.test(email));

email = "elewayru@gmail.com";
var accept = ['gmail','yandex','yahoo'];
var re = new RegExp(accept.join('|'), "i");
print(re.test(email));
*/
