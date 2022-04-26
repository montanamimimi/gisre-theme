import "../css/main.scss"

import Search from './modules/Search';
const search = new Search();




// Menu adaptive

const mommyButtons = document.querySelectorAll('.menu-item-has-children');

mommyButtons.forEach(button => {
    button.addEventListener('click', (e) => {        
        button.classList.toggle('active');
    })
})


const toggleButton = document.querySelector('.toggle-button');
const menu = document.querySelector('.header__menu');

toggleButton.addEventListener('click', (e) => {
    e.preventDefault();
    menu.classList.toggle('active');
})


