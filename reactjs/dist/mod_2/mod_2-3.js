class Toggle extends React.Component {
    constructor(props) {
        super(props);
        this.state = { isToggleOn: true };

        // Это связывание необходимо делать работой `this` в функции обратного вызова
        this.handleClick = this.handleClick.bind(this);
    }

    handleClick() {
        this.setState(prevState => ({
            isToggleOn: !prevState.isToggleOn
        }));
    }

    render() {
        return React.createElement(
            'button',
            { onClick: this.handleClick },
            this.state.isToggleOn ? 'ON' : 'OFF'
        );
    }
}

ReactDOM.render(React.createElement(Toggle, null), document.getElementById('root'));
//# sourceMappingURL=mod_2-3.js.map