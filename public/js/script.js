const RANDOM_QUOTE_API_URL = 'https://api.quotable.io/random';
const word = document.getElementById("word");
const timer = document.getElementById('timer');
const input = document.getElementById("input");

input.focus();

function getRandomQuote() {
    return fetch(RANDOM_QUOTE_API_URL)
        .then(response => response.json())
        .then(data => data.content);
}

async function addWordToDOM() {
    const quote = await getRandomQuote();
    word.innerHTML = '';

    quote.split('').forEach(character => {
        const characterSpan = document.createElement('span')
        characterSpan.innerText = character
        word.appendChild(characterSpan);
    })

    input.value = null;
    startTimer();
}

let startTime

function startTimer() {
    timer.innerText = 0;
    startTime = new Date()
    setInterval(() => {
        timer.innerText = getTimerTime().toString()
    }, 1000)
}

function getTimerTime() {
    return Math.floor((new Date() - startTime) / 1000)
}

function addWordAndCheckIt() {
    addWordToDOM();
}

addWordAndCheckIt()

//event
input.addEventListener("input", (e) => {
    const quoteArray = word.querySelectorAll('span');
    const Value = input.value.split('')

    let correct = true;
    quoteArray.forEach((characterSpan, index) => {
        const character = Value[index]

        if (character === undefined) {
            correct = false;
            characterSpan.classList.remove('correct');
            characterSpan.classList.remove('incorrect');

        } else if (character === characterSpan.innerText) {
            if (correct) {
                characterSpan.classList.add('correct');
                characterSpan.classList.remove('incorrect');
                input.classList.remove('bg-danger')
                input.classList.remove('text-dark')
            } else {
                characterSpan.classList.remove('correct');
                characterSpan.classList.add('incorrect');
                input.classList.add('bg-danger')
                input.classList.add('text-dark')
            }

        } else {
            correct = false;
            characterSpan.classList.remove('correct');
            characterSpan.classList.add('incorrect');
            input.classList.add('bg-danger')
            input.classList.add('text-dark')
        }
    })
    if (correct) {
        alert('Sizning tezligingiz daqiqasiga: ' + Math.floor((quoteArray.length / 5) / (timer.innerText / 60)) + ' ta so\'z')
        addWordToDOM();
    }
});

