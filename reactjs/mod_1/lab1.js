const dataBook = [
    {id: 1, title: "Book 1", author: "Author 1", price: 500},
    {id: 5, title: "Book 2", author: "Author 2", price: 1200},
    {id: 6, title: "Book 3", author: "Author 3", price: null},
];

function Book(props) {
    
}

const books = <div className="books">
    {
        dataBook.map((item, index) => <div className="book" key={index}>
            <h3>{item["title"]}</h3>
            <img src={'http://placehold.it/100x120?text='+item["title"]} alt=""/>
            <p>Автор: {item["author"]}</p>
            <p>Цена: {formatPrice(item["price"])}</p>
        </div>)
    }
</div> ;

ReactDOM.render(
    books,
    document.getElementById('root')
);

function formatPrice(price) {
    return price ? <strong>{price}</strong> : <del>&nbsp;</del>;
}