<footer class="footer">
        <div class="footer__up">
            <div class="container">
                <div class="footer__sections">
                    <div class="footer__section footer__about">
                        <nav class="footer__nav">
                            <h3 class="footer__nav-header">
                            <?php echo __('Смотрите также', 'gisre-theme'); ?>
                            </h3>
                            <div class="footer__first-menu">
                                <?php 
                                wp_nav_menu(array(
                                    'theme_location' => 'footerMenuLocation'
                                ))                        
                            ?>
                            </div>

                        </nav>
                    </div>
                    <div class="footer__section footer__info">
                        <nav class="footer__nav">
                            <h3 class="footer__nav-header">
                            <?php echo __('Полезная информация', 'gisre-theme'); ?>
                            </h3>
                            <div class="footer__first-menu">
                                <?php 
                                wp_nav_menu(array(
                                    'theme_location' => 'footerMenuLocation2'
                                ))                        
                            ?>
                            </div>
                        </nav>
                    </div>
                    <div class="footer__section footer__partners">
                        <h3 class="footer__nav-header">
                        <?php echo __('Исполнители', 'gisre-theme'); ?>
                        </h3>
                        <ul class="footer__nav-list">
                            <li class="footer__nav-item"><?php echo __('Научно образовательный центр "Возобновляемые источники энергии"', 'gisre-theme'); ?></li>
                            <li class="footer__nav-item"><?php echo __('Географический факультет МГУ имени М.В.Ломоносова', 'gisre-theme'); ?></li>
                            <li class="footer__nav-item"><?php echo __('Объединенный институт высоких температур РАН.', 'gisre-theme'); ?></li>
                        </ul>
                    </div>
                    <div class="footer__section footer__contacts">
                        <h3 class="footer__nav-header">
                        <?php echo __('Телефон', 'gisre-theme'); ?>
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
                <p class="footer__copy">&copy; <?php echo __('ГИС Возобновляемые Источники Энергии', 'gisre-theme'); ?></p>
            </div>
        </div>

    </footer>


<?php wp_footer(); ?>
</body>
</html>
