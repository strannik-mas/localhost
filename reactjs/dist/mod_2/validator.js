class App extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            submit: true
        };

        this.validate = this.validate.bind(this);
    }

    validate(e) {
        if (document.getElementById("theme").value && document.getElementById("variant").value) {
            alert('all right');
            if (!this.state.submit) {
                this.setState(prevState => ({
                    submit: !prevState.submit
                }));
            }
        } else {
            e.preventDefault();
            this.setState(prevState => ({
                submit: !prevState.submit
            }));
            return false;
        }
    }

    render() {
        return React.createElement(
            "form",
            { method: "get", action: "http://google.ru/search", target: "_blank", name: "search", onSubmit: this.validate },
            React.createElement(
                "fieldset",
                { className: this.state.submit ? "right" : "wrong" },
                React.createElement(
                    "label",
                    null,
                    "\u0422\u0435\u043C\u0430 \u043E\u043F\u0440\u043E\u0441\u0430:",
                    React.createElement("input", { type: "text", name: "q", id: "theme" })
                ),
                React.createElement(
                    "label",
                    null,
                    "\u0412\u0430\u0440\u0438\u0430\u043D\u0442\u044B \u043E\u0442\u0432\u0435\u0442\u0430:",
                    React.createElement("input", { type: "text", name: "variant", id: "variant" })
                ),
                React.createElement("input", { type: "submit" })
            )
        );
    }

}

ReactDOM.render(React.createElement(App, null), document.getElementById('wrapper'));
//# sourceMappingURL=validator.js.map