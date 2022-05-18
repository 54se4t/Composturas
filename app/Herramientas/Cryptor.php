<?php
    namespace App\Herramientas;
    use Illuminate\Support\Facades\Hash;

    class Cryptor{
        public static function check($data, $hashData) {
            return Hash::check($data, $hashData);
        }
        //Cifrar la contraseña usando HASH
        public static function encrypt($data) {
            return Hash::make($data);
        }
    }
?>
