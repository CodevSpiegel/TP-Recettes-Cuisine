<?php

class Func {

    public function secur_string (string $string): string {

        $return = htmlspecialchars(trim($string));

        // Supprimer également tous les espaces répétés entre chaque caractère!
        $return = preg_replace('/\s\s+/', ' ', $return);

        return $return;
    }

    public function convert_unity(string $unity): string {

        switch ($unity) {
            case 'unités':
                $return = "";
                break;

            case 'gousses':
                $return = $unity." d'";
                break;

            default:
                $return = $unity." de ";
                break;
        }

        return $return;
    }


    public function date_now() {
        $now = new DateTime();
        $now = date_timezone_set($now, timezone_open('Europe/Paris'));
        $now = $now->format('Y-m-d H:i:s');
        return $now;
    }

}
