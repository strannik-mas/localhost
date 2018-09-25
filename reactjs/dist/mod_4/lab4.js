const dataBook = [{ id: 1, title: "Book 1", author: "Author 1", price: 500 }, { id: 5, title: "Book 2", author: "Author 2", price: 1200 }, { id: 6, title: "Book 3", author: "Author 3", price: null }];

class Book extends React.Component {
    constructor(props) {
        super(props);
        this.state = { selected: false };
        this.handleClick = this.handleClick.bind(this);
        this.addBasketBook = this.addBasketBook.bind(this);
    }

    componentDidMount() {
        // console.log("--", "компонент смонтирован");
    }

    handleClick(e) {
        e.preventDefault();
        this.setState({ selected: !this.state.selected });
    }

    addBasketBook(e) {
        e.preventDefault();
        this.props.handleAddBasket(this.props.id);
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
                { href: "#", onClick: this.handleClick },
                "\u0421\u0440\u0430\u0432\u043D\u0438\u0442\u044C"
            ),
            "\xA0",
            React.createElement(
                "a",
                { href: "#", onClick: this.addBasketBook },
                "\u0412 \u043A\u043E\u0440\u0437\u0438\u043D\u0443"
            ),
            React.createElement("div", { className: "likes" })
        );
    }
}

class BookWithoutPrice extends React.Component {
    constructor(props) {
        super(props);
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

        return React.createElement(
            "div",
            { className: "book book_default" },
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
            )
        );
    }
}

class Form extends React.Component {
    constructor(props) {
        super(props);
        this.state = { title: "" };
        this.handleChange = this.handleChange.bind(this);
    }
    handleChange(e) {
        this.setState({ title: e.target.value });
    }
    render() {
        return React.createElement(
            "label",
            null,
            React.createElement("input", { type: "text", onChange: this.handleChange, value: this.state.title }),
            this.state.title
        );
    }
}

class AddBookForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            id: '',
            title: '',
            author: '',
            price: ''
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    isValidBook(book) {
        return book.id && book.title && book.author && true;
    }

    handleChange(e) {
        // console.log(e.target.value);
        this.setState({
            [e.target.name]: e.target.value
        });
        // console.log(this.state);
    }

    handleSubmit(e) {
        e.preventDefault();
        if (this.isValidBook(this.state)) {
            // dataBook.push(this.state);
            this.props.onChange(this.state);
            this.setState({
                id: '',
                title: '',
                author: '',
                price: ''
            });
            // console.log(dataBook);
            // this.props.onChange();
        } else alert("Заполните поля");
    }

    render() {
        return React.createElement(
            "form",
            { action: "", onSubmit: this.handleSubmit },
            React.createElement(
                "div",
                null,
                "id",
                React.createElement("input", { type: "text", name: "id", onChange: this.handleChange, value: this.state.id })
            ),
            React.createElement(
                "div",
                null,
                "\u041D\u0430\u0437\u0432\u0430\u043D\u0438\u0435",
                React.createElement("input", { type: "text", name: "title", onChange: this.handleChange, value: this.state.title })
            ),
            React.createElement(
                "div",
                null,
                "\u0410\u0432\u0442\u043E\u0440\u044B",
                React.createElement("input", { type: "text", name: "author", onChange: this.handleChange, value: this.state.author })
            ),
            React.createElement(
                "div",
                null,
                "\u0426\u0435\u043D\u0430",
                React.createElement("input", { type: "text", name: "price", onChange: this.handleChange, value: this.state.price })
            ),
            React.createElement(
                "div",
                null,
                React.createElement("input", { type: "submit", value: "\u0414\u043E\u0431\u0430\u0432\u0438\u0442\u044C" })
            )
        );
    }
}

class App extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            // counter: 0,
            dataBook: dataBook,
            items: []
        };
        this.addBasket = this.addBasket.bind(this);
        this.removeBasket = this.removeBasket.bind(this);
        this.handleNewBook = this.handleNewBook.bind(this);
    }

    handleNewBook(newBook) {
        this.setState(prevState => ({
            dataBook: prevState.dataBook.push(newBook)
        }));
        /*this.setState(prevState => ({
            counter: prevState.counter+1
        }))*/
    }

    addBasket(id) {
        let items = this.state.items.slice(0); //для копирования
        console.dir(items);
        items[id] = id in items ? ++items[id] : 1;
        this.setState({ items: items });
        console.dir(items);
    }

    removeBasket(id) {
        /*
        let items = this.state.items.slice(0);  //для копирования
        items[id] = items[id]>1 ? --items[id] : delete items[id];
        this.setState({items: items});
        */
        let items = this.state.items.slice(0),
            result = [];
        items[id] = items[id] - 1;
        this.setState({ items: items });

        console.dir(items);
    }

    render() {
        return React.createElement(
            "div",
            { className: "books" },
            React.createElement(Basket, {
                items: this.state.items,
                dataBook: this.state.dataBook,
                handleRemoveBasket: this.removeBasket
            }),
            React.createElement(AddBookForm, { onChange: this.handleNewBook }),
            dataBook.map(item => {
                return item.price ? React.createElement(Book, { title: item.title, author: item.author, price: item.price, key: item.id, id: item.id, handleAddBasket: this.addBasket }) : React.createElement(BookWithoutPrice, { title: item.title, author: item.author, price: item.price, key: item.id });
            })
        );
    }
}

class Basket extends React.Component {
    constructor(props) {
        super(props);
        this.deleteBasketItem = this.deleteBasketItem.bind(this);
    }

    deleteBasketItem(e) {
        e.preventDefault();
        this.props.handleRemoveBasket(e.target.id);
    }

    getIndexById(id) {
        for (let p in this.props.dataBook) {
            if (this.props.dataBook[p]['id'] == id) return p;
        }
        return false;
    }

    render() {
        let items = [],
            j,
            sum = 0;

        for (let i in this.props.items) {
            if (!this.props.items[i]) continue;
            // console.log(this.props.items[i], i);
            j = this.getIndexById(i);
            sum += this.props.items[i] * this.props.dataBook[j]['price'];
            items.push(React.createElement(
                "div",
                { className: "basket-item" },
                React.createElement(
                    "a",
                    { href: "#" },
                    this.props.dataBook[j]['title']
                ),
                React.createElement(
                    "span",
                    null,
                    this.props.items[i],
                    "\u0448\u0442."
                ),
                React.createElement(
                    "span",
                    null,
                    this.props.dataBook[j]['price'],
                    "\u0440\u0443\u0431."
                ),
                React.createElement(
                    "a",
                    { href: "#", onClick: this.deleteBasketItem, id: i },
                    "\u0423\u0434\u0430\u043B\u0438\u0442\u044C"
                )
            ));
        }

        return React.createElement(
            "div",
            { className: "basket" },
            React.createElement(
                "h3",
                null,
                "\u041A\u043E\u0440\u0437\u0438\u043D\u0430"
            ),
            items,
            React.createElement(
                "div",
                { className: "basket-item" },
                React.createElement(
                    "span",
                    null,
                    "\u0412\u0441\u0435\u0433\u043E: ",
                    React.createElement(
                        "b",
                        null,
                        sum
                    ),
                    " \u0440\u0443\u0431."
                )
            )
        );
    }
}

ReactDOM.render(React.createElement(App, null), document.getElementById('root'));

/*for likes*/
class Like extends React.Component {
    constructor(props) {
        super(props);
        this.state = { counter: 0 };

        // Это связывание необходимо делать работой `this` в функции обратного вызова
        this.handleClick = this.handleClick.bind(this);
    }

    handleClick(e) {
        e.preventDefault();
        this.setState(prevState => ({
            counter: prevState.counter + 1
        }));
    }

    render() {
        return React.createElement(
            "div",
            null,
            React.createElement(
                "a",
                { href: "#22", onClick: this.handleClick },
                "likes me"
            ),
            React.createElement(
                "mark",
                null,
                "  ",
                this.state.counter
            )
        );
    }

}

var collection = document.getElementsByClassName('likes');
// console.log(collection);
for (let i = 0; i < collection.length; i++) {
    ReactDOM.render(React.createElement(Like, null), collection[i]);
}
//# sourceMappingURL=lab4.js.map