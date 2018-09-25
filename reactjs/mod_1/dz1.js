function InputText(props) {
    return <label>{props.label}
        <input type="text" name={props.name}/>
    </label>
}

function InputSubmit(props) {
    return <input type="submit"/>
}

function App(props) {
    return <form method="get" action="http://google.ru/search" target="_blank" name="search">
        <InputText name = "q" label="Имя: "/>
        <InputText name = "lname" label="Фамилия: "/>
        <InputText name = "summa" label="Сумма: "/>
        <InputSubmit />
    </form>
}

ReactDOM.render(
    <App></App>
    ,
    document.getElementById('wrapper')
);