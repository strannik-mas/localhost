function NumberList(props) {
    const numbers = props.numbers;
    const listItems = numbers.map(number => React.createElement(
        "li",
        { key: number.toString() },
        number
    ));
    return React.createElement(
        "ul",
        null,
        listItems
    );
}

const numbers = [1, 2, 3, 4, 5];
ReactDOM.render(React.createElement(NumberList, { numbers: numbers }), document.getElementById('root'));

class CustomTextInput extends React.Component {
    constructor(props) {
        super(props);
        this.focus = this.focus.bind(this);
    }

    focus() {
        this.textInput.focus();
        this.textInput.style.border = "5px solid red";
        console.log(ReactDOM.findDOMNode(this));
        ReactDOM.findDOMNode(this).style.opacity = .5;
    }

    render() {
        return React.createElement(
            "div",
            null,
            React.createElement("input", { type: "text", ref: input => {
                    this.textInput = input;
                } }),
            React.createElement("input", { type: "button", value: "Focus this text input", onClick: this.focus })
        );
    }
}
ReactDOM.render(React.createElement(CustomTextInput, null), document.getElementById('refs'));
//# sourceMappingURL=lab3-1.js.map