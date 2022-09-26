<?php 

class GetWinddata {
    function __construct() {
        global $wpdb;
        $tablename = $wpdb->prefix . 'winddb';
        $this->parameters = array(
            'mean_output' => 'Среднесуточная производительность',
            'std_output' => 'Стандартное отклонение',
            'median_output' => 'Медианная производительность',
            'min_output' => 'Минимальная производительность',
            'max_output' => 'Максимальная производительность'
        );
        $this->arg = $this->getArg();               
        $this->$query = "SELECT * FROM $tablename ";
        $this->$query .= $this->createWhereText();
        $this->data = $wpdb->get_results($wpdb->prepare($this->$query, $this->arg));
    }

    function getArg() {
        $lat = round($_GET['lat']*4, 0)/4;
        $lon = round($_GET['lon']*4, 0)/4;
        $types = array('komai', 'sieme', 'lager', 'vesta');
        

        if (is_float($lat) && is_float($lon) && in_array($_GET['wtype'], $types)) {
            return array($lat, $lon, $_GET['wtype']);
        } 
    }

    function createWhereText() {
        
        $lat = round($_GET['lat']*4, 0)/4;
        $lon = round($_GET['lon']*4, 0)/4;

        if (is_float($lat) && is_float($lon)) {
            return " WHERE `lat` = %f AND `lon` = %f AND type = %s ORDER BY `month`";
        } else {

            return "";

        }
    }

    function generateTable() {
        $table = '<div class="dbtable">';

        $table .= '<div class="dbtable__row first-row">
            <div class="dbtable__col dbtable__col-first">
               Показатель
            </div>
            <div class="dbtable__col">
                Янв. 
            </div>
            <div class="dbtable__col">
                Фев.
            </div>
            <div class="dbtable__col">
                Март
            </div>
            <div class="dbtable__col">
                Апр.
            </div>
            <div class="dbtable__col">
                Май 
            </div>
            <div class="dbtable__col">
                Июнь 
            </div>
            <div class="dbtable__col">
                Июль
            </div>
            <div class="dbtable__col">
                Авг.
            </div>
            <div class="dbtable__col">
                Сен.
            </div>
            <div class="dbtable__col">
                Окт.
            </div>
            <div class="dbtable__col">
                Ноя.
            </div>
            <div class="dbtable__col">
                Дек.
            </div>
            <div class="dbtable__col">
                Год 
            </div></div>';

        foreach ($this->parameters as $key => $value) {
            $table .= '<div class="dbtable__row">';
            $table .= '<div class="dbtable__col dbtable__col-first">';
            $table .= $value;   

            for ($i = 0; $i < 13; $i++) {
                $table .= '</div><div class="dbtable__col">';
                $table .= round($this->data[$i]->$key, 2);   
            }
 
            $table .= '</div></div>';
        }

        $table .= '</div>';

        return $table;
    }

}



?>