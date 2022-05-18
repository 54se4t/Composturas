<?php
    namespace App\Herramientas;

    use Illuminate\Http\Request;
    use App\Models\Trabajador;
    use App\Herramientas\Cryptor;

    class TrabajadoresDB{
        public static function getAll() {
            return Trabajador::All();
        }
        public static function getTrabajador($request) {
            return Trabajador::where('TID', $request['tid'])->first();
        }
        public static function getTrabajadorbyEmail($email) {
            return Trabajador::where('email', $email)->first();
        }

        public static function registrar(Request $request) {
            if (!TrabajadoresDB::getTrabajadorbyEmail($request['email'])) {
            //Email no usado, se registra
                $pwCifrado = Cryptor::encrypt($request['password']);
                //Cifra la contraseña
                Trabajador::create([
                    'email' => $request['email'],
                    'nombre' => $request['nombre'],
                    'apellidos' => $request['apellidos'],
                    'password' => $pwCifrado,
                    'permiso' => 'desactivado'
                ]);
                return true;
            }
        }

        public static function registrarGoogle(Request $request) {
            $apellidos = substr($request['displayName'],
                                0,strpos($request['displayName']," "));
            $nombre = substr($request['displayName'],
                            strpos($request['displayName']," "),
                            strlen($request['displayName']));
            Trabajador::create([
                'email' => $request['email'],
                'nombre' => ucfirst($nombre), //1st uppercase
                'apellidos' =>  ucfirst($apellidos), //1st uppercase
                'password' => '',
                'permiso' => 'desactivado',
            ]);
            return true;
        }

        //Comprobar email y password
        public static function login(Request $request) {
            $usuario = TrabajadoresDB::getTrabajadorbyEmail($request['email']);
            if ($usuario) //Falso si no existe este usuario
                return Cryptor::check($request['password'],$usuario['password']);
        }

        //Actualizar datos de un Trabajador
        public static function actualizar(Request $request) {
            $usuario = TrabajadoresDB::getTrabajador($request);
            $usuario -> nombre = $request['nombre'];
            $usuario -> apellidos = $request['apellidos'];
            $usuario -> email = $request['email'];
            $usuario -> permiso = $request['permiso'];
            $usuario -> save();
        }

        public static function setPermiso(Request $request) {
            $usuario = TrabajadoresDB::getTrabajadorbyEmail($request['email']);
            $usuario -> permiso = $request['permiso'];
            $usuario -> save();
        }
    }
?>
