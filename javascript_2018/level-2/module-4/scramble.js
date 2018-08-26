"use strict";
Array.prototype.shuffle = function () {
    if(this.length == 1) return this;
    for(var j,x,i = this.length; i; j = Math.floor(Math.random()*i),
        x = this[--i], this[i] = this[j], this[j] = x);
    return this;

};

var wordList = ["АНТИЛОПА", "БЕГЕМОТ", "АВТОМОБИЛЬ", "ФУТБОЛ", "ПАРОВОЗ", "КОРОБКА", "ПИАНИНО", "ТЕЛЕВИЗОР", "РЕСТОРАН", "ОЛИМПИАДА"];

/*получаем правильное окончание по-русски*/
function ending(num, str, arr) {
    var output = str + arr[0];
    if(num%100 >=11 && num%100 <= 14) return output;
    switch (num%10){
        case 1: output = str + arr[1]; break;
        case 2:
        case 3:
        case 4: output = str + arr[2]; break;
    }
    return output;
}

var currentWord = "",
    numWin = 0,
    numLose = 0,
    TTL = 105,
    secondsLeft = 0,
    timer = null,
    strTimer = null,
    btnStart = null,
    txtResult = null;

function getNewWorld() {
    if(!wordList.length){
        $("h3")[0].innerHTML = "Игра закончена";
        return;
    }
    secondsLeft = TTL;
    changeTimer();
    currentWord = wordList.shuffle().shift();
    $('#strWord').innerHTML = currentWord.split("").shuffle().join("");
    txtResult.value = "";
    txtResult.focus();
    btnStart.disabled = "disabled";

    timer = setInterval(getTime, 1000);
}

function checkInput() {
    console.log(txtResult.value);
    console.log(currentWord);
    if(txtResult.value.toUpperCase() == currentWord){
        numWin++;
        $('#strWin').innerHTML = numWin;
        btnStart.disabled = "";
        clearInterval(timer);
    }
}

function changeTimer() {
    strTimer.innerHTML = secondsLeft;
}

function  getTime() {
    secondsLeft--;
    changeTimer();
    if(secondsLeft <= 0){
        numLose++;
        $('#strLose').innerHTML = numLose;
        clearInterval(timer);
        btnStart.disabled = "";
    }
}

window.onload = function () {
    txtResult = $("#txtResult");
    txtResult.addEventListener("keyup", checkInput);

    btnStart = $("#btnStart");
    btnStart.addEventListener('click', getNewWorld);

    strTimer = $('#strTimer');
    changeTimer();
}