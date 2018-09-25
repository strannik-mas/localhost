function InputText(props) {
    return <div className="field"><label>{props.label}
        <input type="text" name={props.name}/>
    </label></div>
}

function InputSubmit(props) {
    return <input type="submit"/>
}

function App(props) {
    return <form method="get" action="http://google.ru/search" target="_blank" name="search">
        <InputText name = "q" label="Тема опроса: "/>
        <InputText name = "variant" label="Варианты ответа: "/>
        <InputSubmit />
    </form>
}

ReactDOM.render(
    <App></App>
    ,
    document.getElementById('wrapper')
);