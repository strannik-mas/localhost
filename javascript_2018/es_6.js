/*const PI = 3.14;
print(PI);
 PI = 100;  //error! 
let x = 1;
{
	let y = 2;
	{
		print(y);
	}
	
}
// print(y);
for(var i=0; i<5; i++){
	
}
print(i);*/
/*
var arr = [];

for(var i=0; i<3; i++){
	arr[i] = function(){print(i);};
}

for(var i=0; i<3; i++){
	(function(i){
		arr[i] = function(){print(i);};
	})(i);
}
for(let i=0; i<3; i++){
	arr[i] = function(){console.log(i);};
	// arr[i] = function(){print(i);};
}
arr[0]();
arr[1]();
arr[2]();
*/
/*
let foo = x => x*10;
//тоже самое:
let foo = function(x){return x*10;}; 
let foo = (x,y) => x*10;
let foo = () => x*10;
let foo = () => {y = x*10; return y;};

[1,2,3,4,5,6].forEach(v=>print(v*10));
let obj = {
	nums: [1,2,3,4,5,6],
	tens: [],
	each: function(){
		// var self = this;
		this.nums.forEach(function(v){ // эта функция выполнится в контексте глобального объекта
		
			// self.tens.push(v*10);
			this.tens.push(v*10);
		}.bind(this));
	}
};

let obj = {
	nums: [1,2,3,4,5,6],
	tens: [],
	each: function(){
		this.nums.forEach(v => { 
			this.tens.push(v*10);
		});
	}
};
obj.each();
*/
//параметры по умолчанию
/* function foo(x, y){
	x = x || 1;
	y = y || 0;
} 
function foo(x, y=2, z=3){
	print(x+y+z);
}
foo(1);
function foo(x, y, ...a){
	// var a = Array.prototype.slice.call(arguments, 2);
	print(a);
}
foo(1,2,3,4,5,6)
var p = ["a", "b", "c"];
var x = [1,2,...p];
//тоже самое 
// var x = x.concat(p);
var s = "hello";
var a = [...s];
print(a);
var name = "John", age = 25;
var s = `hello ${name}. ${age +1}`;
// String.raw `Hello\nworld`;
console.log(String.raw `Hello\nworld`);
var x=1, y=2;
var obj = {
	// x:x,
	// y:y
	x,y
}
print(obj.x);
var [a,,c] = [1,2,3];		//аналог list в php
[a,c] = [c,a];
var {x,y,z} = {x:1, y:2, z:3};
// print(a,c);
print(x,y,z);*/
/* function foo({a:x, b:y}){}
foo({a:x, b:y}); */
/*
let x = Symbol("this is x");		//для уникальности
let y = Symbol("this is y");
print(x==y);
print(x.toString());
var o = {};
o[x] = 3;
*/
/*
//новые структуры
let m = new Map();
m.set('name', 'John');
m.set('age', 25);
// print(m.size);
// print(m.get('name'));
let s = new Set("hello");
s.add(1).add(2).add('s').add(2);
print(Array.from(s));
// print(s.size);
*/
/*
class Shape{
	constructor(x, y){
		this.x = x;
		this.y = y;
	}
	move(x, y){
		this.x += x;
		this.y += y;
	}
}
let s = new Shape(10, 20);
s.move(3,49);
// console.log(s.x);
class Rect extends Shape{
	constructor(x, y, w, h){
		super(x,y);
		this.w = w;
		this.h = h;
	}
	static foo(){
		return 100;
	}
}
Rect.foo();
// let r = new Rect(10,29, 100,200);

class User{
	constructor(){
		this._name = "";
	}
	set name (n){
		this._name = n.toUpperCase();
	}
	get name (){
		return this._name;
	}
}
let u = new User();
u.name = "John";
console.log(u.name);
console.log(Number.isNaN(1*'d'));*/