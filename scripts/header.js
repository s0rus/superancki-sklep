const hamburger = document.querySelector('.hamburger');
const options = document.querySelector('.option-wrapper');

const quoteEl = document.querySelector('.quote');

const quotes = ['"Zdanie SWI nigdy nie było łatwiejsze!" ~ Maciej K.', '"Sprawdzian stał się banalnie prosty." ~ Tomasz K.'];
let quoteCounter = 0;

const setQuote = () => {
    quoteEl.textContent = quotes[quoteCounter];
    quoteCounter >= 1 ? quoteCounter = 0 : quoteCounter++;
};

setInterval(setQuote, 6000);

const handleClick = () => {
    hamburger.classList.toggle('hamburger--active');
    options.classList.toggle('menu-active');
}


hamburger.addEventListener('click', handleClick);