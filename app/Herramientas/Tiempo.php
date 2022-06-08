<?php
    namespace App\Herramientas;
    use DateTime;

    class Tiempo{
        public static function tiempoDisponible() {
            $tiempoDisponible = [];

            $tiempo = new DateTime(); //Tiempo actual
            $tiempo = $tiempo->modify('+1 day');
            //Convierte todo a numero para facilitar calculo
            $anio = intval($tiempo->format('Y'));
            $mes = intval($tiempo->format('m'));
            $dia = intval($tiempo->format('d'));

            $horaMinuto = [ //Horas disponibles por cada día
                "9:00", "9:30",
                "10:00", "10:30",
                "11:00", "11:30",
                "12:00", "12:30",
                "13:00", "13:30",
                "14:00", "14:30"
            ];

            $countHora = 0; //En siguiente bucle incrementa por cada hora
                            //usada y vuelve a 0 al saltar a siguiente día
            for ($i=0; $i < 120;) {
                $tiempoTexto = //Usa despues para convertir a dataTime
                    $anio."-".$mes."-".$dia." ".$horaMinuto[$countHora];

                $countHora++;

                if ($countHora >= count($horaMinuto)) { //Salta a siguiente día
                    //Calcula el siguiente dia, no detecta año x400, innecesario
                    if ($dia == 31) {
                        switch ($mes) {
                            case 12:
                                $mes = 1;
                                $dia = 1;
                                $anio++;
                                break;
                            case 1: case 3: case 5: case 7:
                            case 8: case 10:
                                $mes++;
                                $dia = 1;
                                break;
                            default:
                                $dia++;
                        }
                    } else if ($dia == 30) {
                        switch ($mes) {
                            case 4: case 6: case 9: case 11:
                                $mes++;
                                $dia = 1;
                            break;
                            default:
                                $dia++;
                        }
                    } else if (($dia == 28) ||
                        ($anio%4 == 0 && $anio%100 == 0 && $dia == 29)) {
                        $mes++;
                        $dia = 1;
                    } else {
                        $dia++;
                    }

                    $countHora = 0; //Reestablece horas usada
                }

                //Convertir a dataTime e añadir a array tiempoDisponible
                $siguiente7Dias = new DateTime($tiempoTexto);
                if (intval($siguiente7Dias->format("w")) != 0) {
                    //echo "<br>".$tiempoTexto;
                    array_push($tiempoDisponible, $siguiente7Dias);
                    $i++;
                }
            }
            return $tiempoDisponible; //devuelve citas de 10 dias (120)
        }
        public static function distanciaDia($dia) {
            $actual = new DateTime();
            $diff = $dia->diff($actual);
            return intval($diff->format('%a'))+1; //devuelve la número de días
                                                  //entre actual y visita
        }
    }
?>
