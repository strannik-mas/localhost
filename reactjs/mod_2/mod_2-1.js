let name= "Vasya";
const element = <div>
    <h1>hello, {name}{3 * 6}</h1>
    <p title="Приветствие" className="some">Lorem</p>
</div>;

/*function Welcome(props) {
    console.log(props);
    return <h1>hey, {props.name}. {props.age}</h1>
}*/

class Welcome extends React.Component {
    constructor(props){
        super(props);
    }
    /*getDefaultProps(){
        return{
            name: "Гость",
            age: 25
        };
    }*/
    render(){
        // console.log(this);
        return <h1>hey, {this.props.name}. {this.props.age}</h1>
    }
}
Welcome.defaultProps = {
    name: "Гость",
    age: 25
};

function App(props) {
    return <div>
    <Welcome name = "vasya" age="45" />
    <Welcome name = "Katya" age="25" />
    <Welcome name = "Petya" />
    <Welcome />
    </div>;

}

ReactDOM.render(
    // element,
    //<Welcome name = "vasya" age="45" />
    <App></App>
    ,
    document.getElementById('root')
);