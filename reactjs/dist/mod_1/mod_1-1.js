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

function Welcome(props) {
    console.log(props);
    return React.createElement(
        "h1",
        null,
        "hey, ",
        props.name,
        ". ",
        props.age
    );
}
/*
class Welcome extends React.Component {
    render(){
        // console.log(this);
        return <h1>hey, {this.props.name}. {this.props.age}</h1>
    }
}
*/
function App(props) {
    return React.createElement(
        "div",
        null,
        React.createElement(Welcome, { name: "vasya", age: "45" }),
        React.createElement(Welcome, { name: "Katya", age: "25" }),
        React.createElement(Welcome, { name: "Petya", age: "70" })
    );
}

ReactDOM.render(
// element,
//<Welcome name = "vasya" age="45" />
React.createElement(App, null), document.getElementById('root'));
//# sourceMappingURL=mod_1-1.js.map