class Timer extends React.Component {
    constructor(props) {
        super(props);
        this.state = { show: false };
    }

    componentDidMount() {
        this.timerID = setTimeout(() => this.tick(), this.props.seconds * 1000);
    }

    componentWillUnMount() {
        clearInterval(this.timerID);
    }

    tick() {
        this.setState({
            show: true
        });
    }

    render() {
        return React.createElement(
            "h2",
            null,
            this.state.show ? "hey" : ""
        );
    }
}
Timer.defaultProps = {
    seconds: 25
};

ReactDOM.render(React.createElement(Timer, { seconds: "10" }), document.getElementById('root'));
//# sourceMappingURL=mod_2-timer.js.map