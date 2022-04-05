import "../css/main.scss"

import Search from './modules/Search';
const search = new Search();


const toggleButton = document.querySelector('.toggle-button');
const menu = document.querySelector('.header__menu');

toggleButton.addEventListener('click', (e) => {
    e.preventDefault();
    menu.classList.toggle('active');
})