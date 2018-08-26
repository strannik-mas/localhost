var book1 = {};
book1.title = 'Ponedelnik';
book1['pubYear'] = 1972;
book1.price = "100RUB";
book1.show = function(){
	print("Name: " + this.title);
	print("Price: " + this.price);
};
var book2 = {
	title: 'Piknik',
	pubYear: 1980,
	price: "200RUB",
	show: showBook
};
book1.show();
book2.show();
function showBook(){
	print("Name: " + this.title);
	print("Price: " + this.price);
}