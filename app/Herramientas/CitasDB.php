<?php
    namespace App\Herramientas;

    use Illuminate\Http\Request;
    use App\Models\Cita;
    use App\Models\Cliente;
    use App\Models\Trabajador;

    class CitasDB{
        //Métodos para obtener cita
        public static function getCita($idCita) {
            return Cita::where('CID', $idCita)->first();
        }
        public static function getCitabyFecha($fecha) {
            return Cita::where('tiempo_visita', $fecha)->first();
        }
        public static function getCitasCliente($idUsuario) {
            return Cita::where('UID', $idUsuario)->get();
        }
        public static function getAll() {
            return Cita::All();
        }

        //El cliente pide cita
        public static function pedirCita($idCliente, $descripcion, $tiempo) {
            Cita::create([
                'UID' => $idCliente,
                'descripcion' => $descripcion,
                'tiempo_visita' => $tiempo,
                'estado' => 'solicitado'
            ]);
        }

        //El trabajador recoge la cita
        public static function recogerCita($idCita, $idTrabajador) {
            $cita = CitasDB::getCIta($idCita);
            $cita -> TID = $idTrabajador;
            $cita -> estado = 'confirmado';
            $cita -> save();
        }

        //El cliente cancela la cita, solo cuando la cita no esta recogida por
        //trabajador
        public static function cancelarCita($idCita) {
            Cita::where('CID', $idCita)->delete();
        }

        public static function setEstado(Request $request) {
            $cita = CitasDB::getCita($request['cid']);
            $cita -> estado = $request['estado'];
            $cita -> save();
        }

        public static function setFecha(Request $request) {
            $cita = CitasDB::getCita($request['cid']);
            $cita -> tiempo_visita = $request['fecha'];
            $cita -> save();
        }
    }
?>
