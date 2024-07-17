<?php

class Template {

    static public function render($vue, $data = array(), $errors = null) {
        $path = PATH_DIR;

        // Extraire les données pour les rendre disponibles dans la vue
        extract($data);

        $user = null;

        // Si l'utilisateur est connecté, ajouter ses informations aux données
        if (isset($_SESSION['oUtilConn'])) {
            $user = $_SESSION['oUtilConn'];
        }

        $templateMain = "view/$vue.php";
        
        if(!isset($user)) {
            $templateMain = "view/connexion.php";
        }


        // Inclure le fichier de la vue
        require "view/template-frontend.php";
    }
    
}