<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Herramientas\ClientesDB;
use App\Herramientas\TrabajadoresDB;
use App\Herramientas\CitasDB;

class AdminController extends Controller
{
    //Iniciar sesión con correo electronico y contraseña
    function login(Request $request) {
        $request -> validate ([
            'email' => 'regex:/^([a-z0-9_]+)@([a-z0-9]+)\.[a-z]{2,6}$/ix',
            'password' => 'regex:/^([a-z0-9\+_\-]{9,16})$/ix'
        ]);
        if (TrabajadoresDB::login($request)) {
            $trabajador = TrabajadoresDB::getTrabajadorbyEmail($request['email']);
            session() -> put('trabajador', $trabajador);
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
    function googleLogin(Request $request){
        if (!TrabajadoresDB::getTrabajadorbyEmail($request['email'])) {
            TrabajadoresDB::registrarGoogle($request);
        }
        $trabajador = TrabajadoresDB::getTrabajadorbyEmail($request['email']);
        session() -> put('trabajador', $trabajador);
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

        if (TrabajadoresDB::registrar($request)) {
            $trabajador = TrabajadoresDB::getTrabajadorbyEmail($request['email']);
            session() -> put('trabajador', $trabajador);
            $html = [
                "estado" => "succeso",
                "mensaje" => "¡Succeso!"
            ];
            return response()->json(array('html'=> $html), 200);
        } else {
            $html = [
                "estado" => "error",
                "mensaje" => "Este correo ya esta registrado"
            ];
            return response()->json(array('html'=> $html));
        }
    }

    //Cerrar sesión
    function logout(Request $request) {
        if (session()->get('trabajador'))
            session()->forget('trabajador');
        return redirect('/');
    }

    //Panel de admin
    function inicio(Request $request) {
        $citas = CitasDB::getAll();
        $trabajadores = TrabajadoresDB::getAll();
        $clientes = ClientesDB::getAll();
        return view('admin.admin-inicio',
        [
            'citas' => $citas,
            'trabajadores' => $trabajadores,
            'clientes' => $clientes
        ]);
    }

    //Confirmar
    function confirmarCita(Request $request) {
        CitasDB::recogerCita($request['cid'], $request['tid']);
        return $this->inicio($request);
    }

    //Editarcita
    function editarCita(Request $request) {
        $test = 0;
        if ($request['coger'] == 'true')
            CitasDB::recogerCita($request['cid'], session()->get('trabajador')['TID']);
        else
            CitasDB::setEstado($request);
        CitasDB::setFecha($request);
        $html = [
            "estado" => "succeso",
            "mensaje" => "¡Succeso!"
        ];
        return response()->json(array('html'=> $html), 200);
    }

    //editar trabajador
    function editarTrabajador(Request $request) {
        if ($request['permiso'] == 'administrador') {
            $html = [
                "estado" => "error",
                "mensaje" => "No puedes editar o subir permiso de administrador"
            ];
            return response()->json(array('html'=> $html), 200);

        } else {
            TrabajadoresDB::actualizar($request);
            $html = [
                "estado" => "succeso",
                "mensaje" => "¡Succeso!"
            ];
            return response()->json(array('html'=> $html), 200);
        }
    }
}

