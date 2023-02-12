<?php 
require_once get_template_directory() . '/includes/GetFotdata.php';

$lat = false;
$lon = false;
$model = false;
$comment = false;
$fotdata = false;

$outline = array(
    'mean_output' => 'Многолетнее среднее',
    'std_output' => 'Стандартное отклонение',
    'median_output' => 'Медиана',
    'min_output' => 'Минимальное значение',
    'max_output' => 'Максимальное значение'
);


if (isset($_GET['lat']) && isset($_GET['lon'])) {
    $lat = $_GET['lat'] + 0.0;
    $lon = $_GET['lon'] + 0.0;
    $model = $_GET['model'];
    $comment = $_GET['comment'];

    $fotdata = new GetFotdata();
}

switch ($model) {
    case 'FU345':
        $header = 'Солнечный фотоэлектрический модуль FuturaSunZebra 345 W';
        break;
    case 'Hevel':
        $header = 'Солнечный фотоэлектрический модуль Hevel 395';
        break;
    case 'JAM72':
        $header = 'Солнечный фотоэлектрический модуль JaSolarHalfCellPERC 72 cellsJAM72S30';
        break;
    default:
        $header = '';
}



$optionsArray = array('gor', 'ver', 'lat', 'm15', 'p15');

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
    <div class="container fot-container">
        <div class="fot-map">
            <h2>Выберите точку на карте</h2>            
            <div id="map" class="yandex-map-fot"></div>
        </div>
        <div class="fot-desc">
            <p>Для отображения данных по производительности ФЭМ выберите коориднаты на карте или введите в форму ниже.
                <!-- Диапазон допустимых значений: 41.5 - 81.5 градусов широты, 20.5 - 173.3 градусов долготы.  -->
            </p>

            <div class="fot-form">
                <form method="GET">
                    <div class="fot-form-items">
                        <div class="fot-form__item">
                            <label for="lat"> Широта</label>
                            <input type="number" name="lat" id="lat" step="1" min="41.5" max="81.5" required
                            <?php if ($lat) { echo ' value="' . $lat . '"'; } ?>
                            >
                        </div>
                        <div class="fot-form__item">
                            <label for="lon"> Долгота</label>
                            <input type="number" name="lon" id="lon" step="1" min="20.5" max="173.5" required
                            <?php if ($lon) { echo ' value="' . $lon . '"'; } ?>
                            >
                        </div>

                    </div>
                    <div class="fot-form-items">
                        <label for="model">Модель ФЭМ</label>
                        <select name="model" id="model">
                            <option value="FU345"
                            <?php if ($model == "FU345") { echo 'selected="true"'; } ?>
                            >FuturaSunZebra 345 W</option>
                            <option value="Hevel"
                            <?php if ($model == "Hevel") { echo 'selected="true"'; } ?>
                            >Hevel 395</option>
                            <option value="JAM72"
                            <?php if ($model == "JAM72") { echo 'selected="true"'; } ?>
                            >JaSolarHalfCellPERC 72 cellsJAM72S30</option>
                        </select>
                    </div>
                    <div class="fot-form-items">
                        <label for="comment">Угол наклона</label>
                        <select name="comment" id="comment">
                            <option value="ALL"
                            <?php if (($comment == "ALL") || !$comment) { echo 'selected="true"'; } ?>
                            >Все значения</option>
                            <option value="gor"
                            <?php if ($comment == "gor") { echo 'selected="true"'; } ?>
                            >0°</option>
                            <option value="m15"
                            <?php if ($comment == "m15") { echo 'selected="true"'; } ?>
                            >широта - 15°</option>
                            <option value="lat"
                            <?php if ($comment == "lat") { echo 'selected="true"'; } ?>
                            >широта</option>
                            <option value="p15"
                            <?php if ($comment == "p15") { echo 'selected="true"'; } ?>
                            >широта+15°</option>
                            <option value="ver"
                            <?php if ($comment == "ver") { echo 'selected="true"'; } ?>
                            >90°</option>
                        </select>
                    </div>
                    <div class="fot-form-items">
                        <div class="fot-form__item">
                            <input type="submit" value="Показать">
                        </div>
                    </div>
                    
                </form>
            </div>

            <?php if ($lat && $lon)  {  
                echo '<p>Показаны данные для: <br> Широта: ' . $lat . '&deg;, Долгота: ' . $lon . '&deg;</p>';

                if (!$fotdata->data) {
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
        latForm.value = Math.round(coords[0]) + '.5';
        lonForm.value = Math.round(coords[1]) + '.5';
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
        <?php if ($fotdata) { ?>

            <h3>Данные по производительности ФЭМ:</h3>
                        
                <h4><?php echo $header; ?></h4>
           
                <?php 

                foreach ($outline as $key => $item) {
                    
                    $prepare = $fotdata->prepareData($fotdata->data, $key);      

                    if ($prepare) {
                        echo '<h4>' . $item . '</h5>';
                        echo $fotdata->generateTable($prepare); 
                    }
                    

                }

                                               
                ?>    

        <?php } ?>


        <div class="fot-description">
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
