function InputText(props) {
    return React.createElement(
        "div",
        { className: "field" },
        React.createElement(
            "label",
            null,
            props.label,
            React.createElement("input", { type: "text", name: props.name })
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
        React.createElement(InputText, { name: "q", label: "\u0422\u0435\u043C\u0430 \u043E\u043F\u0440\u043E\u0441\u0430: " }),
        React.createElement(InputText, { name: "variant", label: "\u0412\u0430\u0440\u0438\u0430\u043D\u0442\u044B \u043E\u0442\u0432\u0435\u0442\u0430: " }),
        React.createElement(InputSubmit, null)
    );
}

ReactDOM.render(React.createElement(App, null), document.getElementById('wrapper'));
//# sourceMappingURL=dz2.js.map