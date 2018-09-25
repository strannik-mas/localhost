let name = "Vasya";
const element = React.createElement(
    "div",
    null,
    React.createElement(
        "h1",
        null,
        "hello, ",
        name,
        3 * 6
    ),
    React.createElement(
        "p",
        { title: "\u041F\u0440\u0438\u0432\u0435\u0442\u0441\u0442\u0432\u0438\u0435", className: "some" },
        "Lorem"
    )
);

/*function Welcome(props) {
    console.log(props);
    return <h1>hey, {props.name}. {props.age}</h1>
}*/

class Welcome extends React.Component {
    constructor(props) {
        super(props);
    }
    /*getDefaultProps(){
        return{
            name: "Гость",
            age: 25
        };
    }*/
    render() {
        // console.log(this);
        return React.createElement(
            "h1",
            null,
            "hey, ",
            this.props.name,
            ". ",
            this.props.age
        );
    }
}
Welcome.defaultProps = {
    name: "Гость",
    age: 25
};

function App(props) {
    return React.createElement(
        "div",
        null,
        React.createElement(Welcome, { name: "vasya", age: "45" }),
        React.createElement(Welcome, { name: "Katya", age: "25" }),
        React.createElement(Welcome, { name: "Petya" }),
        React.createElement(Welcome, null)
    );
}

ReactDOM.render(
// element,
//<Welcome name = "vasya" age="45" />
React.createElement(App, null), document.getElementById('root'));
//# sourceMappingURL=mod_2-1.js.map