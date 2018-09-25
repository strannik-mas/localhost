var cities = ['Москва', "Ленинград", "Куйбышев", "Сталинград", "Ворошиловград", "Харьков"];

function InputOption(props) {
    return React.createElement(
        "option",
        { value: props.val },
        props.opt
    );
}

function InputSelect(props) {
    return React.createElement(
        "label",
        null,
        props.label,
        React.createElement(
            "select",
            { name: props.name },
            cities.map((city, i) => React.createElement(InputOption, { val: city, opt: city, key: i }))
        )
    );
}

function InputSubmit(props) {
    return React.createElement("input", { type: "submit" });
}

function App(props) {
    return React.createElement(
        "form",
        { method: "get", action: "http://google.ru/search", target: "_blank", name: "search" },
        React.createElement(InputSelect, { name: "q", label: "\u0413\u043E\u0440\u043E\u0434: " }),
        React.createElement(InputSubmit, null)
    );
}

ReactDOM.render(React.createElement(App, null), document.getElementById('wrapper'));
//# sourceMappingURL=dz3.js.map