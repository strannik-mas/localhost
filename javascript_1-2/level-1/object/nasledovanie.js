//быстрое наследование
var log = console.log;

/*
function object(parent){
	function F(){}
	F.prototype = parent || Object;
	return new F();
}
var shape = {
	type: "Shape",
	x: 0,
	y: 0
};
var rect = object(shape);
rect.type = "Rectangle";
rect.width = 100;
rect.height = 200;
// log(rect);

var circle = object(shape);
circle.type = "Circle";
circle.x = 10;
circle.y = 20;
circle.r = 150;
// log(circle);

var square = object(rect);
square.type = "Square";
square.width = square.height;
// log(square);
*/
/*
//классическое наследование
function Shape(){
	this.type = "Shape";
	this.x = 0;
	this.y = 0;
}
Shape.prototype.move = function(x,y){
	this.x += x;
	this.y +=y;
	
	return this.type + " moved to " + this.x + ":" + this.y;
};
Shape.prototype.draw = function(){
	return "Draw this " + this.type + " at the point " + this.x + ":" + this.y;
};

function Rectangle(){
	Shape.call(this);
	this.type = "Rectangle";
	
}
Rectangle.prototype = Shape.prototype;
Rectangle.prototype.constructor = Rectangle;

function Circle(){
	Shape.call(this);
	this.type = "Circle";
	
}
Circle.prototype = Shape.prototype;
Circle.prototype.constructor = Circle;		

var rect  = new Rectangle();
var circle = new Circle();
log(rect instanceof Rectangle);
log(rect instanceof Shape);
log(rect instanceof Circle); 			//проверяет не только прямых родителей но и  всех предков, поэтому true

function Square(){
	Rectangle.call(this);
	this.type = "Square";
	
}
Square.prototype = Rectangle.prototype;
// Square.prototype.constructor = Square;

var square = new Square();
log(square);
log(square.move(50,60));
log(square.draw());
log(square instanceof Square);
log(square instanceof Rectangle);
log(square instanceof Shape);
log(square instanceof Circle);
*/
//использование конструкторов встроенных типов
var arr = new Array(3);
// log(arr);
var arr2 = Array.of(3);
// log(arr2);
let emails = ["gmail", "yandex", "hotmail"];
let pattern = new RegExp(emails.join("|"), "i");

function isAcceptableEmail(email){
	// return /gmail|yandex|hotmail/.test(email);		//только для конкретного количества адресов
	
	return pattern.test(email);
}

log(isAcceptableEmail("john@yandex.ru"));
log(isAcceptableEmail("john@mail.ru"));