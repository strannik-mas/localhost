const dataBook = [{ id: 1, title: "Book 1", author: "Author 1", price: 500 }, { id: 5, title: "Book 2", author: "Author 2", price: 1200 }, { id: 6, title: "Book 3", author: "Author 3", price: null }];

class Book extends React.Component {
    constructor(props) {
        super(props);
        this.state = { selected: false };
        this.handleClick = this.handleClick.bind(this);
    }

    componentDidMount() {
        // console.log("--", "компонент смонтирован");
    }

    handleClick(e) {
        e.preventDefault();
        this.setState({ selected: !this.state.selected });
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
                { href: "#" },
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
            id: 0,
            title: '',
            author: '',
            price: null
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
            dataBook.push(this.state);
            this.setState({
                id: 0,
                title: '',
                author: '',
                price: null
            });
            console.log(dataBook);
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
                React.createElement("input", { type: "text", name: "id", onChange: this.handleChange })
            ),
            React.createElement(
                "div",
                null,
                "\u041D\u0430\u0437\u0432\u0430\u043D\u0438\u0435",
                React.createElement("input", { type: "text", name: "title", onChange: this.handleChange })
            ),
            React.createElement(
                "div",
                null,
                "\u0410\u0432\u0442\u043E\u0440\u044B",
                React.createElement("input", { type: "text", name: "author", onChange: this.handleChange })
            ),
            React.createElement(
                "div",
                null,
                "\u0426\u0435\u043D\u0430",
                React.createElement("input", { type: "text", name: "price", onChange: this.handleChange })
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
    }
    render() {
        return React.createElement(
            "div",
            { className: "books" },
            React.createElement(AddBookForm, null),
            dataBook.map(item => {
                return item.price ? React.createElement(Book, { title: item.title, author: item.author, price: item.price, key: item.id }) : React.createElement(BookWithoutPrice, { title: item.title, author: item.author, price: item.price, key: item.id });
            })
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
//# sourceMappingURL=lab3.js.map