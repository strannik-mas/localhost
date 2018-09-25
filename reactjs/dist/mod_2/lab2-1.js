const dataBook = [{ id: 1, title: "Book 1", author: "Author 1", price: 500 }, { id: 5, title: "Book 2", author: "Author 2", price: 1200 }, { id: 6, title: "Book 3", author: "Author 3", price: null }];

/*function Book(props) {
    const price = props.price ? <strong>{props.price}</strong> : <del>&nbsp;</del>;
    return <div className="book">
        <h3>{props["title"]}</h3>
        <img src={'http://placehold.it/100x120?text='+props["title"]} alt=""/>
        <p>Автор: {props["author"]}</p>
        <p>Цена: {price} руб.</p>

    </div>;
}*/

class Book extends React.Component {
    constructor(props) {
        super(props);
        this.state = { selected: false };
    }

    componentDidMount() {
        console.log("--", "компонент смонтирован");
    }

    render() {
        const price = this.props.price ? React.createElement(
            "strong",
            null,
            this.props.price
        ) : React.createElement(
            "del",
            null,
            "\xA0"
        );

        // console.log(this);
        // this.setState({selected: true});     //тут ошибка

        return React.createElement(
            "div",
            { className: "book" + (this.state.selected ? " book_selected" : " book_default") },
            React.createElement(
                "h3",
                null,
                this.props["title"]
            ),
            React.createElement("img", { src: 'http://placehold.it/100x120?text=' + this.props["title"], alt: "" }),
            React.createElement(
                "p",
                null,
                "\u0410\u0432\u0442\u043E\u0440: ",
                this.props["author"]
            ),
            React.createElement(
                "p",
                null,
                "\u0426\u0435\u043D\u0430: ",
                price,
                " \u0440\u0443\u0431."
            ),
            React.createElement(
                "a",
                { href: "#" },
                "\u0421\u0440\u0430\u0432\u043D\u0438\u0442\u044C"
            ),
            "\xA0",
            React.createElement(
                "a",
                { href: "#" },
                "\u0412 \u043A\u043E\u0440\u0437\u0438\u043D\u0443"
            ),
            React.createElement("div", { className: "likes" })
        );
    }
}

function App(props) {
    return React.createElement(
        "div",
        { className: "books" },
        dataBook.map(item => React.createElement(Book, { title: item.title, author: item.author, price: item.price, key: item.id }))
    );
}

ReactDOM.render(React.createElement(App, null), document.getElementById('root'));
//# sourceMappingURL=lab2-1.js.map