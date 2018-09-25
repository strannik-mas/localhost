const dataBook = [{ id: 1, title: "Book 1", author: "Author 1", price: 500 }, { id: 5, title: "Book 2", author: "Author 2", price: 1200 }, { id: 6, title: "Book 3", author: "Author 3", price: null }];

function Book(props) {}

const books = React.createElement(
    "div",
    { className: "books" },
    dataBook.map((item, index) => React.createElement(
        "div",
        { className: "book", key: index },
        React.createElement(
            "h3",
            null,
            item["title"]
        ),
        React.createElement("img", { src: 'http://placehold.it/100x120?text=' + item["title"], alt: "" }),
        React.createElement(
            "p",
            null,
            "\u0410\u0432\u0442\u043E\u0440: ",
            item["author"]
        ),
        React.createElement(
            "p",
            null,
            "\u0426\u0435\u043D\u0430: ",
            formatPrice(item["price"])
        )
    ))
);

ReactDOM.render(books, document.getElementById('root'));

function formatPrice(price) {
    return price ? React.createElement(
        "strong",
        null,
        price
    ) : React.createElement(
        "del",
        null,
        "\xA0"
    );
}
//# sourceMappingURL=lab1.js.map