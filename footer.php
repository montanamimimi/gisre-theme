<footer class="footer">
        <div class="footer__up">
            <div class="container">
                <div class="footer__sections">
                    <div class="footer__section footer__about">
                        <nav class="footer__nav">
                            <h3 class="footer__nav-header">
                                Про нас
                            </h3>
                            <?php 
                              wp_nav_menu(array(
                                'theme_location' => 'footerMenuLocation'
                              ))                        
                            ?>
                        </nav>
                    </div>
                    <div class="footer__section footer__info">
                        <nav class="footer__nav">
                            <h3 class="footer__nav-header">
                                Полезная информация
                            </h3>
                            <ul class="footer__nav-list">
                                <li class="footer__nav-item"><a href="#">Item1</a></li>
                                <li class="footer__nav-item"><a href="#">Itedsdsdm1</a></li>
                                <li class="footer__nav-item"><a href="#">It  dsdsem1</a></li>
                                <li class="footer__nav-item"><a href="#">Itecdssm1</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="footer__section footer__partners">
                        <h3 class="footer__nav-header">
                            Исполнители
                        </h3>
                        <ul class="footer__nav-list">
                            <li class="footer__nav-item">Научно образовательный центр "Возобновляемые источники энергии"</li>
                            <li class="footer__nav-item">Географический факультет МГУ имени М.В.Ломоносова</li>
                            <li class="footer__nav-item">Объединенный институт высоких температур РАН.</li>
                        </ul>
                    </div>
                    <div class="footer__section footer__contacts">
                        <h3 class="footer__nav-header">
                            Контакты
                        </h3>
                        <p class="footer__nav-p"> +7 (495) 939 41 63 </p>
                        <h3 class="footer__nav-header">
                            Email
                        </h3>
                        <p class="footer__nav-p"> info@gisre.ru </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer__down">
            <div class="container">
                <p class="footer__copy">&copy; ГИС Возобновляемые Источники Энергии</p>
            </div>
        </div>
    </footer>


<?php wp_footer(); ?>
</body>
</html>
