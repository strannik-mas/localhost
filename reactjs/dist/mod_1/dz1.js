function InputText(props) {
    return React.createElement(
        "label",
        null,
        props.label,
        React.createElement("input", { type: "text", name: props.name })
    );
}

function InputSubmit(props) {
    return React.createElement("input", { type: "submit" });
}

function App(props) {
    return React.createElement(
        "form",
        { method: "get", action: "http://google.ru/search", target: "_blank", name: "search" },
        React.createElement(InputText, { name: "q", label: "\u0418\u043C\u044F: " }),
        React.createElement(InputText, { name: "lname", label: "\u0424\u0430\u043C\u0438\u043B\u0438\u044F: " }),
        React.createElement(InputText, { name: "summa", label: "\u0421\u0443\u043C\u043C\u0430: " }),
        React.createElement(InputSubmit, null)
    );
}

ReactDOM.render(React.createElement(App, null), document.getElementById('wrapper'));
//# sourceMappingURL=dz1.js.map