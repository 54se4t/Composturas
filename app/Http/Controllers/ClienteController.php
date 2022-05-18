<?php

namespace App\Http\Controllers;

use DateTime;

use Illuminate\Http\Request;
use App\Herramientas\ClientesDB;
use App\Herramientas\CitasDB;
use App\Herramientas\Tiempo;

class ClienteController extends Controller
{
    //Iniciar sesión con correo electronico y contraseña
    function login(Request $request) {
        $request -> validate ([
            'email' => 'regex:/^([a-z0-9_]+)@([a-z0-9]+)\.[a-z]{2,6}$/ix',
            'password' => 'regex:/^([a-z0-9\+_\-]{9,16})$/ix'
        ]);
        if (ClientesDB::login($request)) {
            $usuario = ClientesDB::getClientebyEmail($request['email']);
            session() -> put('usuario', $usuario);
            $html = [
                "estado" => "succeso",
                "mensaje" => "Has iniciado la sesión"
            ];
            return response()->json(array('html'=> $html), 200);
        } else {
            $html = [
                "estado" => "error",
                "mensaje" => "Email o contraseña invalido"
            ];
            return response()->json(array('html'=> $html));
        }
    }

    //Iniciar sesión con cuenta google
    public function googleLogin(Request $request){
        if (!ClientesDB::getClientebyEmail($request['email'])) {
            ClientesDB::registrarGoogle($request);
        }
        $usuario = ClientesDB::getClientebyEmail($request['email']);
        session() -> put('usuario', $usuario);
        $html = [
            "estado" => "succeso",
            "mensaje" => "Has iniciado la sesión"
        ];
        return response()->json(array('html'=> $html), 200);

    }

    //Registrar
    function registrar(Request $request) {
        $request -> validate ([
            'email' => 'regex:/^([a-z0-9_]+)@([a-z0-9]+)\.[a-z]{2,6}$/ix',
            'nombre' => 'regex:/^[a-z0-9]{1,50}/i',
            'apellidos' => 'regex:/^[a-z0-9]{1,50}/i',
            'password' => 'regex:/^([a-z0-9\+_\-]{9,16})$/ix'
        ]);

        if (ClientesDB::registrar($request)) {
            $usuario = ClientesDB::getClientebyEmail($request['email']);
            session() -> put('usuario', $usuario);
            $html = [
                "estado" => "succeso",
                "mensaje" => "¡Succeso!"
            ];
            return response()->json(array('html'=> $html), 200);
        } else {
            $html = [
                "estado" => "error",
                "mensaje" => "Este email ya esta usado"
            ];
            return response()->json(array('html'=> $html));
        }

    }

    //Cerrar sesión
    function logout(Request $request) {
        if (session()->get('usuario'))
            session()->forget('usuario');
        return redirect('/');
    }

    //Página de citas
    function pedidos(Request $request) {
        $tiempos = Tiempo::tiempoDisponible();
        $citas = CitasDB::getAll();
        for ($i = 0; $i < count($tiempos); $i++) {
            foreach ($citas as $cita) {
                if ($cita['tiempo_visita']
                    == $tiempos[$i]->format('Y-m-d H:i:s')) {
                    array_splice($tiempos, $i, 1);
                }
            }
        }
        //Citas
        $cliente = session()->get('usuario')['UID'];
        $citas = CitasDB::getCitasCliente($cliente);
        return view('cliente.cliente-pedidos', ['mensaje' => [
            'citas' => $citas,
            'tiempos' => $tiempos
            ]]);
    }

    //Pedir cita
    function pedirCita(Request $request) {
        $tiempos = Tiempo::tiempoDisponible();
        $citas = CitasDB::getAll();
        for ($i = 0; $i < count($tiempos); $i++) {
            foreach ($citas as $cita) {
                if ($cita['tiempo_visita']
                    == $tiempos[$i]->format('Y-m-d H:i:s')) {
                    array_splice($tiempos, $i, 1);
                }
            }
        }
        $idUsuraio = session()->get('usuario')['UID'];
        $fecha = $request['cita'];
        $decripcion = $request['descripcion'];
        foreach ($tiempos as $cita) {
            if ($cita->format('Y-m-d H:i:s') == $fecha) {
                CitasDB::pedirCita($idUsuraio, $decripcion, $fecha);
                $html = [
                    "estado" => "succeso",
                    "mensaje" => "¡Succeso!"
                ];
                return response()->json(array('html'=> $html), 200);
            }
        }
        $html = [
            "estado" => "error",
            "mensaje" => "Cita no disponible:".$fecha
        ];
        return response()->json(array('html'=> $html));
    }

    //Cancelar cita
    function cancelarCita(Request $request) {
        $cita = CitasDB::getCitabyFecha($request['fecha']);
        $dist = Tiempo::distanciaDia(new DateTime($cita['tiempo_visita']));
        if ($dist <= 1) {
            $html = [
                "estado" => "error",
                "mensaje" => "No puedes cancelar la cita pasada o del siguiente día!"
            ];
            return response()->json(array('html'=> $html));
        } else {
            CitasDB::cancelarCita($cita['CID']);
            $html = [
                "estado" => "succeso",
                "mensaje" => "¡Succeso!"
            ];
            return response()->json(array('html'=> $html), 200);
        }
    }

    //editar perfil
    function editarPerfil(Request $request) {
        $request -> validate ([
            'email' => 'regex:/^([a-z0-9_]+)@([a-z0-9]+)\.[a-z]{2,6}$/ix',
            'nombre' => 'regex:/^[a-z0-9]{1,50}/i',
            'apellidos' => 'regex:/^[a-z0-9]{1,50}/i',
            'password' => 'regex:/^([a-z0-9\+_\-]{9,16})$/ix',
            'oldPassword' => 'regex:/^([a-z0-9\+_\-]{9,16})$/ix'
        ]);
        if(ClientesDB::actualizar($request)) {
            $html = [
                "estado" => "succeso",
                "mensaje" => "¡Succeso!"
            ];
            if (session()->get('usuario'))
                session()->forget('usuario');
            $usuario = ClientesDB::getClientebyEmail($request['email']);
            session() -> put('usuario', $usuario);
            return response()->json(array('html'=> $html), 200);
        } else {
            $html = [
                "estado" => "error",
                "mensaje" => "La contraseña antigua no es correcta"
            ];
            return response()->json(array('html'=> $html));
        }
    }
}
