//функции $.each, .shuffle() и $() из библиотеки lib.js
var TTL = 10,
    wrongTime = 3,
    overallCards = 16,
    counterWrong = 0,
    cardsOffsetArr = [
        '-42px -32px', '-264px -32px', '-486px -32px', '-708px -32px', '-930px -32px',
        '-42px -323px', '-264px -323px', '-486px -323px', '-708px -323px',
        '-42px -651px', '-264px -651px', '-486px -651px', '-711px -652px', '-942px -652px',
        '-40px -962px', '-264px -962px', '-491px -967px', '-711px -962px',
        '-40px -1309px', '-277px -1306px', '-509px -1306px', '-746px -1306px', '-992px -1306px', '-1240px -1306px', '-1510px -1306px',
        '-40px -1609px', '-259px -1609px', '-480px -1609px', '-700px -1609px', '-920px -1609px',
        '-40px -1900px', '-259px -1900px', '-480px -1900px', '-699px -1903px',
        '-52px -2210px', '-287px -2210px', '-581px -2203px', '-827px -2202px',
        '-55px -2515px', '-288px -2515px', '-582px -2500px', '-828px -2499px'
    ],
    divCards = document.getElementsByClassName('box__image'),
    spanWrong = document.getElementById('wrong'),
    tmpOffsets = [];

window.onload = function () {
    let j =0;
    spanWrong = document.getElementById('wrong');
    $.each(divCards, (div) => {
        div.setAttribute('num', j);
        div.addEventListener('click', clickCard);
        j++;
    });
    sessionStorage.setItem('newgame', false);
    sessionStorage.setItem('opened', 0);
}

function newGame() {
    sessionStorage.setItem('newgame', true);
    sessionStorage.setItem('opened', 0);
    sessionStorage.setItem('openedCards', 0);

    let rndCard = '';
    tmpOffsets = [];
    let j =0;
    counterWrong = 0;
    spanWrong.innerHTML = counterWrong;
    let tmpArr = cardsOffsetArr;

    for(let i=0; i<divCards.length/2; i++) {
        rndCard = tmpArr.shuffle().shift();
        tmpOffsets.push(rndCard), tmpOffsets.push(rndCard);
    }
    tmpOffsets = tmpOffsets.shuffle();
    $.each(divCards, (div) => {
        showCard(div, j);
        j++;
    });
    // console.log(tmpOffsets);

    setTimeout(() => {
        $.each(divCards, (div) => {
            revertCard(div);
        });
    }, TTL*1000);
}

function clickCard(e) {
    let opened = sessionStorage.getItem('opened')*1;
    let curOffsetNum = e.target.getAttribute('num');
    if(sessionStorage.getItem('newgame') && opened < 2) {
        showCard(e.target, curOffsetNum);
        opened++;
        sessionStorage.setItem('opened', opened);
        sessionStorage.setItem('card' + opened, curOffsetNum);
        if(opened === 2 && tmpOffsets[sessionStorage.getItem('card1')] != tmpOffsets[sessionStorage.getItem('card2')]){
            counterWrong++;
            spanWrong.innerHTML = counterWrong;
            setTimeout(() => {
                revertCard(divCards[sessionStorage.getItem('card1')]);
                revertCard(divCards[sessionStorage.getItem('card2')]);
                sessionStorage.setItem('opened', 0);
            }, wrongTime*1000);

        }else if(opened === 2 && tmpOffsets[sessionStorage.getItem('card1')] == tmpOffsets[sessionStorage.getItem('card2')]){


            sessionStorage.setItem('openedCards',
                sessionStorage.getItem('openedCards')*1 + 2);
            if(sessionStorage.getItem('openedCards')*1 === overallCards){

                $.each(divCards, (div) => {
                    div.removeEventListener('click', clickCard);

                });
                setTimeout(() => {
                    alert('Игра выиграна!');
                    return;
                }, 1000);
            }
            sessionStorage.setItem('opened', 0);
        }
    }
}

function showCard(element, num) {
    element.setAttribute('class', 'box__image box__image_face');
    element.style.backgroundPosition = tmpOffsets[num*1];
}

function revertCard(element) {
    element.style.backgroundPosition = '';
    element.setAttribute('class', 'box__image box__image_back');
}
