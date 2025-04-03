<?php 
require_once get_template_directory() . '/includes/Database.php';
$winddata = new GetWinddata();

get_header(); ?>


<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=b6a7a43d-4ce5-45d6-9b18-5eb8015dbbfa" type="text/javascript"></script>




<section class="single-banner">
  <div class="container">
    <div class="single-banner__content">
     <h1><?php the_title(); ?></h1>
    </div>
  </div>
</section>



<section>
    <div class="container db-container">
        <div class="db-map">
            <h2>Выберите точку на карте</h2>            
            <div id="map" class="yandex-map-db"></div>
        </div>
        <div class="db-desc">
            <p>Для отображения данных выберите координаты на карте или введите в форму ниже.
            </p>



            <div class="db-form">
                <form method="GET">
                    <div class="db-form-items">
                        <div class="db-form__item">
                            <label for="lat"> Широта</label>
                            <input type="text" name="lat" id="lat"  required
                            <?php if ($_GET['lat']) { echo ' value="' . $_GET['lat'] . '"'; } ?>
                            >
                        </div>
                        <div class="db-form__item">
                            <label for="lon"> Долгота</label>
                            <input type="text" name="lon" id="lon" required
                            <?php if ($_GET['lon']) { echo ' value="' . $_GET['lon'] . '"'; } ?>
                            >
                        </div>

                    </div>
                    <div class="db-form-items">
                        <label for="model">Модель ВЭУ</label>
                        <select name="wtype" id="wtype">
                            <option value="komai"
                            <?php if ($_GET['wtype'] == "komai") { echo 'selected="true"'; } ?>
                            >Komai_KWT300</option>
                            <option value="sieme"
                            <?php if ($_GET['wtype'] == "sieme") { echo 'selected="true"'; } ?>
                            >Siemens Gamesa SG 3.4-132</option>
                            <option value="lager"
                            <?php if ($_GET['wtype'] == "lager") { echo 'selected="true"'; } ?>
                            >LagerweyL100</option>
                            <option value="vesta"
                            <?php if ($_GET['wtype'] == "vesta") { echo 'selected="true"'; } ?>
                            >VestasV126</option>
                        </select>
                    </div>
  
                    <div class="db-form-items">
                        <div class="db-form__item">
                            <input type="submit" value="Показать">
                        </div>
                    </div>
                    
                </form>
            </div>

            <?php 
            
            if ($_GET['lat'] && $_GET['lon'])  {  
                echo '<p>Показаны данные для: <br> Широта: ' . $_GET['lat'] . '&deg;, Долгота: ' . $_GET['lon'] . '&deg;</p>';

                if (!$winddata->data) {
                    echo '<h3>Для этих координат нет данных. Выберите точку на территории России</h3>';
                }
            }         
            
            ?>
        </div>

    </div>
</section>

<script>

ymaps.ready(init);
var myMap;

function init () {
    myMap = new ymaps.Map("map", {
        center: [64.5, 97.5], 
        zoom: 3
    }, {
        balloonMaxWidth: 200,
        searchControlProvider: 'yandex#search'
    });

    const latForm = document.getElementById('lat');
    const lonForm = document.getElementById('lon');

    myMap.events.add('click', function (e) {

        var coords = e.get('coords');
        latForm.value = Math.round(coords[0]*1000)/1000;
        lonForm.value = Math.round(coords[1]*1000)/1000;
        latForm.classList.add('lat-selected');
        lonForm.classList.add('lat-selected');

        setTimeout(() => {
        latForm.classList.remove('lat-selected');
        lonForm.classList.remove('lat-selected');
        }, 800)

    });


    myMap.events.add('balloonopen', function (e) {
        myMap.hint.close();
    });
}
</script>


<section>
    <div class="container">
        <?php if ($winddata->data) { ?>

            <h3>Данные по производительности ВЭУ:</h3>

            
        
                <?php 
                
                echo $winddata->generateTable();
                               
                ?>




           
        <?php } ?>


        <div class="db-description">
            <h3></h3>
        </div>
    </div>
</section>

<section class="single-text">
  <div class="container">

        
        <div class="single-text__content">
          <?php the_content();  ?> 
        </div>
  </div>
</section>

<?php get_footer(); ?>
