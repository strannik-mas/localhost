class Clock extends React.Component{
    constructor(props){
        super(props);
        this.now = new Date();
        this.now.setHours(this.now.getUTCHours() + this.props.timezone*1);
        this.state = {
            date: this.now,
        }
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
        let now = new Date();
        now.setHours(now.getUTCHours() + this.props.timezone*1);
        this.setState({
            date: now
        });
    }

    render(){
        return (
            <div>
                <h1>{this.props.city} time is: </h1>
                <h2>{this.state.date.toLocaleTimeString()}</h2>
            </div>
        );
    }
}

ReactDOM.render(
    <div>
        <Clock timezone="3" city="Moscow"/>
        <Clock timezone="2" city="Berlin"/>
        <Clock timezone="9" city="Tokio"/>
    </div>
    ,
    document.getElementById('clock')
);