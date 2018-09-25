class Clock extends React.Component{
    constructor(props){
        super(props);
        this.state = {date: new Date()}
    }

    componentDidMount(){
        this.timerID = setInterval(
            () => this.tick(), 1000
        );
    }

    componentWillUnMount(){
        clearInterval(this.timerID);
    }

    tick() {
        this.setState({
            date: new Date()
        });
    }

    render(){
        return (
            <div>
                <h1>My clock</h1>
                {/*<h1>My clock {Math.random()}</h1>*/}
                {/*<h2>It is {this.props.date.toLocaleTimeString()}</h2>*/}
                <h2>It is {this.state.date.toLocaleTimeString()}</h2>
            </div>
        );
    }
}

ReactDOM.render(
    <Clock />,
    document.getElementById('clock')
);

/*function tick() {
    ReactDOM.render(
        <Clock date={new Date()} />,
        document.getElementById('clock')
    );
}

setInterval(tick, 1000);*/