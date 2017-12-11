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