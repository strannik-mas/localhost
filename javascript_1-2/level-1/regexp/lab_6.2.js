function getDate(str){
	var f = str.match(/^(\d\d?)-(\d\d?)-(\d{4})$/);
	if(!f)
		throw new Error("Неверный формат даты!");
	return new Date(f[3], f[2]-1, f[1]);	
}

var s1 = "325-02-1987";
var s2 = "25-1-1933";
var s3 = "01-23-1983";
var s4 = "98s84-02-1987";
try{
	var d = getDate(s2)
	// print(d.toString());
	WScript.Echo(d.toString());
}catch(e){
	// print(e.message);
	WScript.Echo(e.message);
}
