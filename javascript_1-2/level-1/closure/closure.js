function foo(base, count, action){
	for(var i=base; i<=count; i++){
		action(i);
	}
}
// foo (1,10, print);
// foo (1,10, function(x){/**/});


/* function say(){
	var greet = "X";
	return function(name){
		return greet + " " + name;
	};
}
var greet = "Hello";
var en = say();
var ru = say();
print (en("John"));
print (en("Mike"));

greet = "Privet";
print (ru("Vasya"));
print (ru("Petya")); */