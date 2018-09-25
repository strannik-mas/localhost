class Clock extends React.Component {
    constructor(props) {
        super(props);
        this.state = { date: new Date() };
    }

    componentDidMount() {
        this.timerID = setInterval(() => this.tick(), 1000);
    }

    componentWillUnMount() {
        clearInterval(this.timerID);
    }

    tick() {
        this.setState({
            date: new Date()
        });
    }

    render() {
        return React.createElement(
            'div',
            null,
            React.createElement(
                'h1',
                null,
                'My clock'
            ),
            React.createElement(
                'h2',
                null,
                'It is ',
                this.state.date.toLocaleTimeString()
            )
        );
    }
}

ReactDOM.render(React.createElement(Clock, null), document.getElementById('clock'));

/*function tick() {
    ReactDOM.render(
        <Clock date={new Date()} />,
        document.getElementById('clock')
    );
}

setInterval(tick, 1000);*/
//# sourceMappingURL=clock.js.map