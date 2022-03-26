import axios from "axios"

class Search {
    constructor() {
        this.deploySearch();
        this.searchResults = document.getElementById('search-results');
        this.openSearchButton = document.getElementById('search-btn');
        this.closeSearchButton = document.getElementById('close-search');
        this.searchOverlay = document.getElementById('our-search-overlay');
        this.searchField = document.getElementById('search-term');
        this.events();
        this.typingTimer;
        this.prevValue;
        this.searchSpinner = false;
    }

    events() {        
        this.openSearchButton.addEventListener('click', this.openOverlay.bind(this));
        this.closeSearchButton.addEventListener('click', this.closeOverlay.bind(this));
        document.addEventListener('keydown', this.keyPressEvent.bind(this));
        this.searchField.addEventListener('keyup', this.typingLogic.bind(this));
    }

    keyPressEvent(e) {
        if ((e.code == 'Escape') && this.searchOverlay.classList.contains('search-overlay--active')) {
            this.closeOverlay();
        }
    }

    typingLogic(e) {

        if (this.searchField.value != this.prevValue) {
            clearTimeout(this.typingTimer);

            if (this.searchField.value) {
                if (!this.searchSpinner) {
                    this.searchResults.innerHTML = '<p>Ищем подходящие результаты...</p>';
                    this.searchSpinner = true;
                }
                this.typingTimer = setTimeout(this.getResults.bind(this), 750);
            } else {
              this.searchResults.innerHTML = '';
              this.searchSpinner = false;
            }
            this.prevValue = this.searchField.value;            
        }

    }

    async getResults() {
        try {
            const response = await axios.get(gisreData.root_url + '/wp-json/gisre/v1/search?term=' + this.searchField.value)
            const results = response.data;

            console.log(results)
            
            let searchTitle = 'Результаты поиска:'
            let isAny = 0;
            isAny = isAny + results.generalInfo.length + results.books.length + results.eobjects.length

            if (isAny == 0) {
                searchTitle = 'Ничего не найдено'
            } 

            this.searchResults.innerHTML = `<h3>${searchTitle}</h3>            

            <div class="search__group" >
            ${results.generalInfo.map(resultGeneral => `<div class="search__items">
                <svg class="search__news-image" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="48px" height="48px"><path d="M 7.5 6 C 5.0324991 6 3 8.0324991 3 10.5 L 3 35.5 C 3 39.071938 5.9280619 42 9.5 42 L 38.5 42 C 42.071938 42 45 39.071938 45 35.5 L 45 20.5 C 45 18.032499 42.967501 16 40.5 16 L 39 16 L 39 10.5 C 39 8.0324991 36.967501 6 34.5 6 L 7.5 6 z M 7.5 9 L 34.5 9 C 35.346499 9 36 9.6535009 36 10.5 L 36 17.253906 A 1.50015 1.50015 0 0 0 36 17.740234 L 36 34.5 A 1.50015 1.50015 0 1 0 39 34.5 L 39 19 L 40.5 19 C 41.346499 19 42 19.653501 42 20.5 L 42 35.5 C 42 37.450062 40.450062 39 38.5 39 L 9.5 39 C 7.5499381 39 6 37.450062 6 35.5 L 6 10.5 C 6 9.6535009 6.6535009 9 7.5 9 z M 10.5 15 A 1.50015 1.50015 0 1 0 10.5 18 L 31.5 18 A 1.50015 1.50015 0 1 0 31.5 15 L 10.5 15 z M 10.5 23 A 1.50015 1.50015 0 0 0 9 24.5 L 9 31.5 A 1.50015 1.50015 0 0 0 10.5 33 L 17.5 33 A 1.50015 1.50015 0 0 0 19 31.5 L 19 24.5 A 1.50015 1.50015 0 0 0 17.5 23 L 10.5 23 z M 23.5 23 A 1.50015 1.50015 0 1 0 23.5 26 L 31.5 26 A 1.50015 1.50015 0 1 0 31.5 23 L 23.5 23 z M 12 26 L 16 26 L 16 30 L 12 30 L 12 26 z M 23.5 30 A 1.50015 1.50015 0 1 0 23.5 33 L 31.5 33 A 1.50015 1.50015 0 1 0 31.5 30 L 23.5 30 z"/></svg>
                <a href="${resultGeneral.link}" class="search__group-title">${resultGeneral.title}</a> </div>
            `).join('')}     
            
            ${results.eobjects.map(resultObjects => `<div class="search__items">
            <a href="${resultObjects.link}" class="search__group-title">${resultObjects.title}</a>  </div>
            `).join('')}   

            ${results.books.map(resultBooks => `<div class="search__items">
            <a href="${resultBooks.link}" class="search__group-title">${resultBooks.title}</a>  </div>
            `).join('')}   

            </div>                  
            `;
            this.isSpinnerVisible = false;
        } catch (e) {
            console.log(e)
          }
    }
  

    openOverlay() {
        document.querySelector('body').classList.add('body-no-scroll');     
        this.searchOverlay.classList.add('search-overlay--active');
        setTimeout(() => this.searchField.focus(), 301);
    }

    closeOverlay() {
        this.searchOverlay.classList.remove('search-overlay--active');
        document.querySelector('body').classList.remove('body-no-scroll'); 
        this.searchField.value = '';  
    }

    deploySearch() {
        document.body.insertAdjacentHTML('beforeend', `
        <div class="search-overlay" id="our-search-overlay">
            <div class="search-overlay__top">
            <div class="container search-overlay__container">
                <span class="search-overlay__icon">
                    <svg class="search-overlay__icon-image" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 64 64" width="64px" height="64px"><path d="M 24 2.8886719 C 12.365714 2.8886719 2.8886719 12.365723 2.8886719 24 C 2.8886719 35.634277 12.365714 45.111328 24 45.111328 C 29.036552 45.111328 33.664698 43.331333 37.298828 40.373047 L 52.130859 58.953125 C 52.130859 58.953125 55.379484 59.435984 57.396484 57.333984 C 59.427484 55.215984 58.951172 52.134766 58.951172 52.134766 L 40.373047 37.298828 C 43.331332 33.664697 45.111328 29.036548 45.111328 24 C 45.111328 12.365723 35.634286 2.8886719 24 2.8886719 z M 24 7.1113281 C 33.352549 7.1113281 40.888672 14.647457 40.888672 24 C 40.888672 33.352543 33.352549 40.888672 24 40.888672 C 14.647451 40.888672 7.1113281 33.352543 7.1113281 24 C 7.1113281 14.647457 14.647451 7.1113281 24 7.1113281 z"/></svg>
                </span>
                <input type="text" class="search-term" placeholder="Что вы ищете?" id="search-term" autocomplete="off">
                <span class="search-overlay__close" id="close-search">
                    <svg class="search-overlay__close-icon" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width="50px" height="50px"><path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"/></svg>
                </span>
            </div>
            </div>
            <div class="container">
            <div id="search-results" class="search__results">
        
            </div>
            </div>
        </div>        
        `)
    }
}

export default Search