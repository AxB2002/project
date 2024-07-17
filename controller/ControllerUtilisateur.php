<?php

requirePage::model('CRUD');
requirePage::model('Utilisateur');
requirePage::library('Validation');
// require_once('controller/ControllerAdmin.php');

class ControllerUtilisateur extends Controller {

    
    public function index() {
        
        if($_SESSION['type_id'] == 1 || $_SESSION['type_id'] == 2){
            
            $profil = new ControllerAdmin;
            $profil->profilUsager($_SESSION['user_id']);

        }else {
            RequirePage::url('connexion');  
        }
        
    }

    public function hasRoleAccess($roles = array()) {
        $user = $_SESSION['oUtilConn'];

        if(!isset($user) || !in_array($user['Role'], $roles)) {
            return false;
        }

        return true;
    }

    public function create($values = array(), $success = null, $errors = null) {
        $roles = [
            Utilisateur::ROLE_EMPLOYE => 'Employé',
            Utilisateur::ROLE_ADMIN => 'Admin',
            Utilisateur::ROLE_MEMBRE => 'Membre'
        ];
        
        return Template::render('creer-utilisateur', ['roles' => $roles, "success" => $success, "values" => $values], $errors);
    }


    public function store() {
        if(!$this->hasRoleAccess([Utilisateur::ROLE_ADMIN])) {
            return $this->create(null, false, "Vous n'êtes pas autorisé à créer un utilisateur");
        }

        $validation = new Validation;
        extract($_POST);

        $validation->name('Nom')->value($Nom)->required();
        $validation->name('Prenom')->value($Prenom)->required();
        $validation->name('Courriel')->value($Courriel)->pattern('email')->required();
        $validation->name('Telephone')->value($Telephone)->pattern('tel')->required();
        $validation->name('Mot_De_Passe')->value($Mot_De_Passe)->max(225)->min(8)->required();
        $validation->name('Role')->value($Role)->required();

        if (!$validation->isSuccess()) {
            $errors = $validation->displayErrors();
           
            return $this->create($_POST, false, $errors);
        }

        $utilisateur = new Utilisateur;

        $utilisateur->insert($_POST);

        $this->create(null, true);
    }   

    public function list($success = null, $errors = null) {
        $utilisateur = new Utilisateur;
    
        // Récupérer les données de recherche si elles sont disponibles
        $search = isset($_POST['search']) ? $_POST['search'] : '';
    
        // Effectuer la recherche des utilisateurs en fonction du critère de recherche
        $users = $utilisateur->searchUsers($search);
    
        // Rendre le template avec les utilisateurs trouvés et les éventuelles erreurs
        return Template::render('lister-utilisateurs', [
            'users' => $users,
            'search' => $search,
        ], $errors);
    }

    public function delete() {
        if(!$this->hasRoleAccess([Utilisateur::ROLE_ADMIN])) {
            return $this->list(false, "Vous n'êtes pas autorisé à supprimer les utilisateurs");
        }


        if(!isset($_POST["Code_Membre"])) {
            return $this->list();
        }

        $codeMembre = $_POST["Code_Membre"];

        $utilisateur = new Utilisateur;
        $utilisateur->delete($codeMembre);

        $this->list();
    } 

}