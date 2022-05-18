<?php
    namespace App\Herramientas;

    use Illuminate\Http\Request;
    use App\Models\Cliente;
    use App\Herramientas\Cryptor;

    class ClientesDB{
        public static function getAll() {
            return Cliente::All();
        }

        public static function getCliente($id) {
            return Cliente::where('UID', $id)->first();
        }

        //Devolver un usuario con email introducido
        public static function getClientebyEmail($email) {
            return Cliente::where('email', $email)->first();
        }

        public static function registrar(Request $request) {
            if (!ClientesDB::getClientebyEmail($request['email'])) {
            //Email no usado, se registra
                $pwCifrado = Cryptor::encrypt($request['password']);
                //Cifra la contraseña
                Cliente::create([
                    'email' => $request['email'],
                    'nombre' => $request['nombre'],
                    'apellidos' => $request['apellidos'],
                    'password' => $pwCifrado
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
            Cliente::create([
                'email' => $request['email'],
                'nombre' => ucfirst($nombre), //1st uppercase
                'apellidos' =>  ucfirst($apellidos), //1st uppercase
                'password' => ''
            ]);
            return true;
        }

        //Comprobar email y password
        public static function login(Request $request) {
            $usuario = ClientesDB::getClientebyEmail($request['email']);
            if ($usuario) {//Falso si no existe este usuario
                return Cryptor::check($request['password'],$usuario['password']);
            }
        }

        //Actualizar datos de un cliente
        public static function actualizar(Request $request) {
            $usuario = ClientesDB::getCliente(session()->get('usuario')['UID']);
            if (Cryptor::check($request['oldPassword'],$usuario['password'])) {
                $usuario -> nombre = $request['nombre'];
                $usuario -> apellidos = $request['apellidos'];
                $usuario -> email = $request['email'];
                $pwCifrado = Cryptor::encrypt($request['password']);
                $usuario -> password = $pwCifrado;
                $usuario -> save();
                return true;
            } else {
                return false;
            }
        }
    }
?>
