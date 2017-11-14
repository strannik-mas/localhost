function compare(x){
	return function(y){
		if(y==x) return null;
		return y>x;
	};
}

var f1 = compare(1);
var f2 = compare(22);

print(f1(1));