// Object.prototype.z = 33;
/*function User(n,a){
	this.name = n;
	this.age = a;
	this.admin = false;
	 this.say = function(w){
		print(this.name);
	}; */
}
/*
var u1 = new User("Jogn", 15);
u1.admin = true;
// print(u1);

var u2 = new User('',35);
// print(u2.constructor);
for(var i in u1){
	if(u1.hasOwnProperty(i))
		print(i, ":", u1[i]);
}
print(u1 instanceof Array);
// console.dir(u1.toString());

User.prototype.x = 10;
User.prototype.say = function(w){
	print(this.name, ":", w)
};
// u1.constructor.prototype.x = 10;
// console.log(u2.x);
// console.dir(u1);

var u = new User("Sasha", 34);
// console.dir(u.say);




Number.prototype.pow = function(x){
	return Math.pow(this.valueOf(), x);
};

function func(){
	return Array.prototype.slice.call(arguments);
}
print(func(1,2,3,4,5,6,7));



var arr = [];
print(arr.constructor);
var arr2 = new Array(5);
print(arr2);

var n1 = 10;
console.log(typeof n1);

var n2 = new Number(10);
console.log(typeof n2);
console.log(n2);
console.log(n2.valueOf());

var s = "hello";	//var tmp = new String(s)
					//tmp.length
					//delete tmp

s.x = 10;			//var tmp = new String(s)
					//tmp.x = 10
					//delete tmp

s.x;				//var tmp = new String(s)
					//tmp.x
					//delete tmp

print(s.x);

*/




/* //алфавит
var aIdx = 97;
var alphabet = "";
for(var i=0; i<26; i++)
	alphabet += String.fromCharCode(aIdx+i)
print(alphabet);

var digits = "";
for(var i=0; i<10; i++)
	digits += i;
print(digits);

function buildString(n, callback){
	var result = "";
	for(var i=0; i<n; i++)
		result += callback(i);
	return result;
}
alphabet = buildString(26, function(i){
	var aIdx = 97;
	return String.fromCharCode(aIdx+i);
});
digits = buildString(10, function(i){
	return i;
});
print(alphabet);
print(digits);
//immediatly invoked function expression
(function(){
	print("sss");
})();

function foo(){
	var a = [];
	
	for(var i=0; i<3; i++)
		
		// a.push(function(){
			// print(j);
		// })
		
		(function(j){
			a.push(function(){
				print(j);
			})
		})(i);
		
	return a;
}

var x = foo();
x[0]();		//3		0
x[1]();		//3		1
x[2]();		//3 	2 */