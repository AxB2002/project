<?php

class ControllerHome extends Controller {

    public function index() {

        return Template::render('accueil');

    }

    public function error($e = null){
        
        return 'error '.$e;
    }

}