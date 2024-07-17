<?php

class Document extends CRUD {
    protected $table = 'document';
    protected $primaryKey = 'Code_Document';

    protected $fillable = [
        'Code_Document', 
        'Titre', 
        'Auteur', 
        'AnneeProduction', 
        'Categorie', 
        'Type', 
        'Genre', 
        'Description', 
        'ISBN'
    ];

    const CATEGORIE_ROMAN = 'roman';
    const CATEGORIE_BANDE_DESSINEE = 'bande_dessinee';
    const CATEGORIE_JEUX_VIDEO = 'jeux_video';
    const CATEGORIE_DVD = 'DVD';
    const CATEGORIE_BLU_RAY = 'Blu_ray';
    const CATEGORIE_CD = 'CD';

    const TYPE_ENFANT = 'enfant';
    const TYPE_ADO = 'ado';
    const TYPE_ADULTE = 'adulte';

    const GENRE_COMEDIE = 'comédie';
    const GENRE_DRAME = 'drame';
    const GENRE_HORREUR = 'horreur';
    const GENRE_SCI_FI = 'sci_fi';
    const GENRE_DOCUMENTAIRE = 'documentaire';

    public function checkDocument($documentId) {
        $sql = "SELECT * FROM $this->table WHERE Code_Document = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute(array($documentId));
        $count = $stmt->rowCount();

        if ($count === 1) {
            $document_info = $stmt->fetch();
            return $document_info;
        } else {
            return "Document non trouvé";
        }
    }

    public function searchDocuments($search) {
        $sql = "SELECT d.*, 
                       CASE
                           WHEN r.Reservation_ID IS NOT NULL THEN 'réservé'
                           ELSE 'non réservé'
                       END AS Etat_Reservation,
                       r.Reservation_ID AS Reservation_ID
                FROM $this->table d 
                LEFT JOIN Reservation r ON d.Code_Document = r.Code_Document AND r.Status = 'reserve'
                WHERE d.Titre LIKE ? OR d.Auteur LIKE ?";
        
        $params = ["%$search%", "%$search%"];
        
        $stmt = $this->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function reserveDocument($documentId, $userId, $dateRetour) {
        // Votre logique pour enregistrer la réservation dans la base de données avec le statut "reserve"
        $sql = "INSERT INTO Reservation (Code_Document, Code_Membre, Status, Date_Reservation_Debut, Date_Reservation_Retour) 
                VALUES (?, ?, 'reserve', NOW(), ?)";
        $stmt = $this->prepare($sql);
        return $stmt->execute([$documentId, $userId, $dateRetour]);
    }

    
}

?>