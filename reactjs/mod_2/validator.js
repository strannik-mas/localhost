class App extends React.Component{
    constructor(props){
        super(props);
        this.state = {
            submit: true
        };
        
        this.validate = this.validate.bind(this);
    }

    validate(e){
        if(document.getElementById("theme").value && document.getElementById("variant").value){
            alert('all right');
            if(!this.state.submit){
                this.setState(prevState => ({
                    submit: !prevState.submit
                }));
            }
        }else {
            e.preventDefault();
            this.setState(prevState => ({
                submit: !prevState.submit
            }));
            return false;
        }
    }

    render(){
        return <form method="get" action="http://google.ru/search" target="_blank" name="search" onSubmit={this.validate}>
            <fieldset  className={this.state.submit ? "right" : "wrong"}>
                <label>Тема опроса:
                    <input type="text" name="q" id="theme"/>
                </label>
                <label>Варианты ответа:
                    <input type="text" name="variant" id="variant" />
                </label>
                <input type="submit" />
            </fieldset>
        </form>
    }

}

ReactDOM.render(
    <App></App>
    ,
    document.getElementById('wrapper')
);