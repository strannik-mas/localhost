class Like extends React.Component{
    constructor(props) {
        super(props);
        this.state = {counter: 0};

        // Это связывание необходимо делать работой `this` в функции обратного вызова
        this.handleClick = this.handleClick.bind(this);
    }

    handleClick(e) {
        e.preventDefault();
        this.setState(prevState => ({
            counter: prevState.counter+1
        }));
    }

    render(){
        return (
            <div>
                <a href="#22" onClick={this.handleClick}>
                    likes me
                </a>
                <mark>  {this.state.counter}</mark>
            </div>
        );
    }

}

var collection = document.getElementsByClassName('likes');
console.log(collection);
for(let i=0; i<collection.length; i++){
    ReactDOM.render(
        <Like />
        ,
        collection[i]
    );
}
