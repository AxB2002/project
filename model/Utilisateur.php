<?php

class Utilisateur extends CRUD {

    protected $table = 'utilisateur';
    protected $primaryKey = 'Code_Membre';

    protected $fillable = ['Code_Membre', 'Prenom', 'Nom', 'Adresse', 'Telephone', 'Courriel', 'Mot_De_Passe', 'Role'];

    const ROLE_EMPLOYE = 'employe';
    const ROLE_ADMIN = 'admin';
    const ROLE_MEMBRE = 'membre';

    public function checkUser($courriel, $password = null) {
        $sql = "SELECT * FROM $this->table WHERE Courriel = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($courriel));
        $count = $stmt->rowCount();

        if ($count === 1) {
            $info_user = $stmt->fetch();

            if ($password != null) {
                if($password === $info_user["Mot_De_Passe"]) {
                // if (password_verify($password, $info_user['Mot_De_Passe'])) {
                    session_regenerate_id();
                    $_SESSION['oUtilConn'] = $info_user;

                    return null;
                } else {
                    return "Courriel ou mot de passe incorrect";
                }
            }
        } else {
            return "Courriel ou mot de passe incorrect";
        }
    }

    public function getAllMembres() {
        $sql = "SELECT Code_Membre, Nom, Prenom FROM Utilisateur WHERE Role = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute([self::ROLE_MEMBRE]);
        return $stmt->fetchAll();
    }

    public function searchUsers($search) {
        $sql = "SELECT * FROM utilisateur WHERE 
                Prenom LIKE ? OR
                Nom LIKE ? OR
                Adresse LIKE ? OR
                Telephone LIKE ? OR
                Courriel LIKE ?";
        
        $params = ["%$search%", "%$search%", "%$search%", "%$search%", "%$search%"];
    
        $stmt = $this->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}

?>