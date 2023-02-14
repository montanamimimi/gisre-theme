<?php 

class GetFotdata {
    function __construct() {
        global $wpdb;
        $tablename = $wpdb->prefix . 'photovoltaic';
        $this->arg = $this->getArg();               
        $query = "SELECT * FROM $tablename ";
        $query .= $this->createWhereText();
        $this->data = $wpdb->get_results($wpdb->prepare($query, $this->arg));
   
    }


    function getArg() {
        $lat = $_GET['lat'] + 0.0;
        $lon = $_GET['lon'] + 0.0;
        $module = sanitize_text_field($_GET['model']);

        if (is_float($lat) && is_float($lon)) {
            return array($lat, $lon, $module);
        } 
    }

    function createWhereText() {
        $lat = $_GET['lat'] + 0.0;
        $lon = $_GET['lon'] + 0.0;


        if (isset($_GET['lat']) && isset($_GET['lon'])) {
            $lat = $_GET['lat'] + 0.0;
            $lon = $_GET['lon'] + 0.0;
        }

        if (is_float($lat) && is_float($lon)) {
           
            return " WHERE `lat` = %f AND `lon` = %f AND `module` = %s ORDER BY `angle`, `comment`";
        } else {

            return "";

        }


    }

    function prepareData($data, $type) {

        $prepare = array();        
        $comment = sanitize_text_field($_GET['comment']);

        foreach ($data as $item) {

            if ($comment != 'ALL') {
                if ($item->comment == $comment) {
                    if (!isset($prepare[$item->comment])) {
                        $prepare[$item->comment] = array();
                        $prepare[$item->comment]['angle'] = $item->angle;
                    }
        
                    $prepare[$item->comment][$item->mm] = $item->$type;
                }
            } else {
                if (!isset($prepare[$item->comment])) {
                    $prepare[$item->comment] = array();
                    $prepare[$item->comment]['angle'] = $item->angle;
                }
    
                $prepare[$item->comment][$item->mm] = $item->$type;
            }



        }

        return $prepare;

    }

    function myTrim($item) {
        return rtrim(rtrim(number_format($item, 4, ',', ' '), '\0'), '\,');
    }

    function generateTable($params) {
        $table = '<div class="femtable">';

        $table .= '<div class="femtable__row first-row">
            <div class="femtable__col">
                Угол
            </div>
            <div class="femtable__col femtable__col-small">
               Наклон
            </div>
            <div class="femtable__col">
                Янв. 
            </div>
            <div class="femtable__col">
                Фев.
            </div>
            <div class="femtable__col">
                Март
            </div>
            <div class="femtable__col">
                Апр.
            </div>
            <div class="femtable__col">
                Май 
            </div>
            <div class="femtable__col">
                Июнь 
            </div>
            <div class="femtable__col">
                Июль
            </div>
            <div class="femtable__col">
                Авг.
            </div>
            <div class="femtable__col">
                Сен.
            </div>
            <div class="femtable__col">
                Окт.
            </div>
            <div class="femtable__col">
                Ноя.
            </div>
            <div class="femtable__col">
                Дек.
            </div>
            <div class="femtable__col">
                Год 
            </div></div>';

        foreach ($params as $key => $value) {
            $table .= '<div class="femtable__row">';
            $table .= '<div class="femtable__col">';
            $table .= $value['angle'] . '&deg;';
            $table .= '</div><div class="femtable__col femtable__col-small">';
            $table .= '<img src="' . get_theme_file_uri() .'/assets/images/' . $key . '_2.png" width="50px">';        
            $table .= '</div><div class="femtable__col">';
            $table .= $this->myTrim($value['1']);       
            $table .= '</div><div class="femtable__col">';
            $table .= $this->myTrim($value['2']);       
            $table .= '</div><div class="femtable__col">';
            $table .= $this->myTrim($value['3']);       
            $table .= '</div><div class="femtable__col">';
            $table .= $this->myTrim($value['4']);       
            $table .= '</div><div class="femtable__col">';
            $table .= $this->myTrim($value['5']);       
            $table .= '</div><div class="femtable__col">';
            $table .= $this->myTrim($value['6']);       
            $table .= '</div><div class="femtable__col">';
            $table .= $this->myTrim($value['7']);       
            $table .= '</div><div class="femtable__col">';
            $table .= $this->myTrim($value['8']);       
            $table .= '</div><div class="femtable__col">';
            $table .= $this->myTrim($value['9']);       
            $table .= '</div><div class="femtable__col">';
            $table .= $this->myTrim($value['10']);       
            $table .= '</div><div class="femtable__col">';
            $table .= $this->myTrim($value['11']);       
            $table .= '</div><div class="femtable__col">';
            $table .= $this->myTrim($value['12']);       
            $table .= '</div><div class="femtable__col">';
            $table .= $this->myTrim($value['13']);       
            $table .= '</div></div>';
        }

        $table .= '</div>';

        return $table;
    }

}



?>