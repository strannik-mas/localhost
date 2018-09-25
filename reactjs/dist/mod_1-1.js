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
ReactDOM.render(element, document.getElementById('root'));
//# sourceMappingURL=mod_1-1.js.map