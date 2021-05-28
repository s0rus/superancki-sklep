const hamburger = document.querySelector('.hamburger');
const options = document.querySelector('.option-wrapper');
const page = document.querySelector('html');

const quoteEl = document.querySelector('.quote');

const quotes = ['"Zdanie SWI nigdy nie było łatwiejsze!" ~ Maciej K.', '"Sprawdzian stał się banalnie prosty." ~ Tomasz K.'];
let quoteCounter = 0;

const setQuote = () => {
    quoteEl.textContent = quotes[quoteCounter];
    quoteCounter >= 1 ? quoteCounter = 0 : quoteCounter++;
};

if (quoteEl) {
    setInterval(setQuote, 6000);
}


const handleClick = () => {
    hamburger.classList.toggle('hamburger--active');
    options.classList.toggle('menu-active');
    page.classList.toggle('page-locked');
}


hamburger.addEventListener('click', handleClick);