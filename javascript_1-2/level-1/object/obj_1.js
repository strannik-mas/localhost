/* var o = {
	param:10,
	method: function(){
		var self = this;
		function test(){
			print(self.param);
		}
		// test();				//in global's object context
		test();
	}
}
o.method();
 */
/*
 function some(a,b){
	// print(some.length);			//count of parameters
	// print(this.age);
	print(arguments.length);		//count of parameters in fact
	print(arguments[5])
}
var age=10;
some();

var john = {
	0: "a",
	1: "b",
	2: "c",
	age: 34,
	name: "strannik",
	say: function(word){
		print(word + " from " + this.name);
		this.foo();
	},
	foo: some
};
// john.say("hello");
// for(var i = 0; i in user; i++)
	// print(i + ": " + user[i]);

var mike = {
	name: "Mike",
	age:100
};
print(some.length);
some.call(mike, 10,20,30,40,50,60,70);	
*/
	
// mike.x = john.say;
// mike.x("hello"); 

var a = [5, 45,3,89,100];
var m = Math.min.apply(Math, a);
print(m);