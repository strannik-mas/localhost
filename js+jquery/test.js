var a = 1;
var b = 2;
var func = (function f() {return a+b;}, function g() {return 13;})();
func;