class Clock extends React.Component {
    constructor(props) {
        super(props);
        this.now = new Date();
        this.now.setHours(this.now.getUTCHours() + this.props.timezone * 1);
        this.state = {
            date: this.now
        };
    }

    componentDidMount() {
        this.timerID = setInterval(() => this.tick(), 1000);
    }

    componentWillUnMount() {
        clearInterval(this.timerID);
    }

    tick() {
        let now = new Date();
        now.setHours(now.getUTCHours() + this.props.timezone * 1);
        this.setState({
            date: now
        });
    }

    render() {
        return React.createElement(
            "div",
            null,
            React.createElement(
                "h1",
                null,
                this.props.city,
                " time is: "
            ),
            React.createElement(
                "h2",
                null,
                this.state.date.toLocaleTimeString()
            )
        );
    }
}

ReactDOM.render(React.createElement(
    "div",
    null,
    React.createElement(Clock, { timezone: "3", city: "Moscow" }),
    React.createElement(Clock, { timezone: "2", city: "Berlin" }),
    React.createElement(Clock, { timezone: "9", city: "Tokio" })
), document.getElementById('clock'));
//# sourceMappingURL=clock_many.js.map