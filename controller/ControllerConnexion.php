<?php

requirePage::model('CRUD');
requirePage::model('Utilisateur');
requirePage::library('Validation');
requirePage::library('Template');

class ControllerConnexion extends Controller {

    public function index() {
        return Template::render('connexion');
    }

    public function auth() {
        $validation = new Validation;
        extract($_POST);

        if(!isset($Courriel) || !isset($Mot_De_Passe)) {
            return;
        }

        $utilisateur = new Utilisateur;
        $errors = $utilisateur->checkUser($_POST['Courriel'], $_POST['Mot_De_Passe']);
        
        if(isset($errors)) {
            $_SESSION['errors'] = $errors;
            RequirePage::url('connexion');
        } else {
            RequirePage::url('');
        }
    }

    public function logout(){
        session_destroy();
        RequirePage::url('connexion');
    }

}