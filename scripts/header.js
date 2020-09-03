const hamburger = document.querySelector('.hamburger');
const options = document.querySelector('.option-wrapper');

const handleClick = () => {
    hamburger.classList.toggle('hamburger--active');
    options.classList.toggle('menu-active');
}

hamburger.addEventListener('click', handleClick);