/*
//проблемы:
//callback функции - многоуровневая вложенность
var x = function(err, foo1){
	foo1(function(err, foo2){
		foo2(function(err, foo3)){
			...
		}
	}
}

//несвязанность событий для одного и того же елемента
img.addEventListener("load", foo);
///
img.addEventListener("error", bar);
*/

//Promise
// var p = new Promise(function(resolve, reject){});
// var p = new Promise(()=>{});
// console.log(p);

const willGift = new Promise(
	(resolve, reject) => {
		let win = Math.random().toFixed(1);
		if(win > 0.5)
			resolve("Ты выиграл");
		else 
			reject("Ты не выиграл");
	}
);
/* const writeOnFb = function(gift){
	// return new Promise((resolve, reject) => resolve("Я выиграл!"));
	return Promise.resolve("Я выиграл!");
}; */
const buyTicket = function(){
	console.log("Покупаю билет");
	willGift
		// .then(writeOnFb)
		.then(result => console.log(result))
		.catch(error => console.dir(error));
	console.log(";lkjasdfassdf");
};
buyTicket();