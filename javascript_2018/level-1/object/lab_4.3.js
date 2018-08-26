var a = [5,12];
var b = [];
a[99] = 7;

/* for(var i = 0; i<a.length; i++){
	b.push(Math.pow(a[i], 2));
}
print(b); */
var b = [];
for(var i in a){
	b.push(Math.pow(a[i], 2));
	// print(i);
}
print(b);