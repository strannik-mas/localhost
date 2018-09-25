class Autotag extends React.Component {
    constructor(props) {
        super(props);
        this.handleInput = this.handleInput.bind(this);
        this.state = {isChanged: false};
        // this.state = {value:''}
    }

    handleInput(e) {
        if(e.target.value){
            this.setState({isChanged: true});
            let str = e.target.value;
            str = str.split(' ');
            this.textDiv.innerHTML = '';
            str.forEach(item => {
                if(item.charAt(0) == '#' || item.charAt(0) == '@'){
                    this.textDiv.innerHTML += '<a href="#">' + item + '</a><br>';
                }
            });
        }

    }

    render() {
        return <form action="" onSubmit={this.handleSubmit}>
            <textarea name="text" onChange={this.handleInput}></textarea>
            {/*<textarea name="text" onChange={this.handleInput} value={this.state.value}></textarea>*/}
            <div ref={(div) => {this.textDiv = div;}}></div>
            {/*<div><a href="#">{this.state.value}</a></div>*/}


        </form>
    }
}

ReactDOM.render(
    <Autotag />,
    document.getElementById('root')
);