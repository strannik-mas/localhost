function Book(t,y,p){
	this.title = t;
	this.pubYear = y;
	this.price = p;
}
var book1 = new Book('Ponedelnik', 1978, '200RUB');
Book.prototype.show = function(){
	print("Nazv: " + this.title);
	print("Price: " + this.price);
};
book1.show();