function NumberList(props) {
    const numbers = props.numbers;
    const listItems = numbers.map((number) =>
        <li key={number.toString()}>{number}</li>
    );
    return (
        <ul>{listItems}</ul>
    );
}

const numbers = [1, 2, 3, 4, 5];
ReactDOM.render(
    <NumberList numbers={numbers} />,
    document.getElementById('root')
);

class CustomTextInput extends React.Component {
    constructor(props){
        super(props);
        this.focus = this.focus.bind(this)
    }

    focus() {
        this.textInput.focus();
        this.textInput.style.border = "5px solid red";
        console.log(ReactDOM.findDOMNode(this));
        ReactDOM.findDOMNode(this).style.opacity = .5;
    }

    render(){
        return(
            <div>
                <input type="text" ref={(input) => {this.textInput = input;}} />
                <input type="button" value="Focus this text input" onClick={this.focus}/>
            </div>
        );
    }
}
ReactDOM.render(
    <CustomTextInput />,
    document.getElementById('refs')
);