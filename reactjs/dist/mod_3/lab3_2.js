class Autotag extends React.Component {
    constructor(props) {
        super(props);
        this.handleInput = this.handleInput.bind(this);
        this.state = { isChanged: false };
        // this.state = {value:''}
    }

    handleInput(e) {
        if (e.target.value) {
            this.setState({ isChanged: true });
            let str = e.target.value;
            str = str.split(' ');
            this.textDiv.innerHTML = '';
            str.forEach(item => {
                if (item.charAt(0) == '#' || item.charAt(0) == '@') {
                    this.textDiv.innerHTML += '<a href="#">' + item + '</a><br>';
                }
            });
        }
    }

    render() {
        return React.createElement(
            'form',
            { action: '', onSubmit: this.handleSubmit },
            React.createElement('textarea', { name: 'text', onChange: this.handleInput }),
            React.createElement('div', { ref: div => {
                    this.textDiv = div;
                } })
        );
    }
}

ReactDOM.render(React.createElement(Autotag, null), document.getElementById('root'));
//# sourceMappingURL=lab3_2.js.map