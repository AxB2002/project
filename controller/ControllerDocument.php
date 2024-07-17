<?php

requirePage::model('CRUD');
requirePage::model('Document');
requirePage::model('Utilisateur');
requirePage::model('Reservation');
requirePage::library('Validation');
// require_once('controller/ControllerAdmin.php');

class ControllerDocument extends Controller {
    public function index() {
        
    }

    public function hasRoleAccess($roles = array()) {
        $user = $_SESSION['oUtilConn'];

        if(!isset($user) || !in_array($user['Role'], $roles)) {
            return false;
        }

        return true;
    }


    public function list($success = null, $errors = null) {
        $document = new Document;

        $search = isset($_POST['search']) ? $_POST['search'] : '';

        $documents = $document->searchDocuments($search);

        // Render the view with documents and user information
        return Template::render('lister-documents', [
            'documents' => $documents,
            'search' => $search
        ], $errors);
    }

    public function afficherFormulaireReservation() {
        $documentId = isset($_POST['document_id']) ? $_POST['document_id'] : null;
        $user = $_SESSION['oUtilConn'];

        // Charger la liste des membres si l'utilisateur est un employé
        $membres = [];
        if ($user['Role'] == Utilisateur::ROLE_EMPLOYE || $user['Role'] == Utilisateur::ROLE_ADMIN) {
            $utilisateur = new Utilisateur;
            $membres = $utilisateur->getAllMembres();
        }

        return Template::render('reserver-document', [
            'document_id' => $documentId,
            'membres' => $membres,
            'user' => $user,
        ]);
    }

    public function reserver() {
        $documentId = isset($_POST['document_id']) ? $_POST['document_id'] : null;
        $dateRetour = isset($_POST['date_retour']) ? $_POST['date_retour'] : null;
        $document = new Document;

        // Vérifier si le document existe
        $docInfo = $document->checkDocument($documentId);
        if ($docInfo === "Document non trouvé") {
            $errors[] = "Le document que vous essayez de réserver n'existe pas.";
            return $this->list(null, $errors);
        }

        // Vérifier si l'utilisateur est un membre ou employé
        $user = $_SESSION['oUtilConn'];

        // Si l'utilisateur est un employé, vérifier le membre sélectionné
        $membreId = $user['Code_Membre'];
        if ($user['Role'] == Utilisateur::ROLE_EMPLOYE || $user['Role'] == Utilisateur::ROLE_ADMIN) {
            $membreId = isset($_POST['code_membre']) ? $_POST['code_membre'] : null;
            if (empty($membreId)) {
                $errors[] = "Vous devez sélectionner un membre pour effectuer une réservation.";
                return $this->list(null, $errors);
            }
        }

        // Effectuer la réservation avec la date de retour
        $reservationSuccess = $document->reserveDocument($documentId, $membreId, $dateRetour);

        if ($reservationSuccess) {
            return RequirePage::url("Document/list");
        } else {
            $errors[] = "Erreur lors de la réservation du document. Veuillez réessayer.";
            return $this->list(null, $errors);
        }
    }

    public function pretDocument() {
        $documentId = isset($_POST['document_id']) ? $_POST['document_id'] : null;
        $reservationId = isset($_POST['reservation_id']) ? $_POST['reservation_id'] : null;
        $user = $_SESSION['oUtilConn'];
    
        // Vérifier si l'utilisateur est autorisé à effectuer des prêts (rôle d'employé)
        if ($user['Role'] != Utilisateur::ROLE_EMPLOYE && $user['Role'] != Utilisateur::ROLE_ADMIN) {
            $errors[] = "Vous n'êtes pas autorisé à effectuer des prêts de documents.";
            return $this->list(null, $errors);
        }
    
        // Vérifier si le document existe et s'il est réservé
        $document = new Document;
        $docInfo = $document->checkDocument($documentId);
        if ($docInfo === "Document non trouvé") {
            $errors[] = "Le document que vous essayez de prêter n'existe pas.";
            return $this->list(null, $errors);
        }
    
        // Vérifier si la réservation existe et si elle est encore active
        $reservation = new Reservation;
        $resInfo = $reservation->checkReservation($reservationId);
        if ($resInfo === "Réservation non trouvée" || $resInfo['Status'] != Reservation::STATUS_RESERVE) {
            $errors[] = "La réservation que vous essayez de prêter n'est pas valide.";
            return $this->list(null, $errors);
        }
    
        // Effectuer le prêt du document en mettant à jour le statut de la réservation
        $updateReservation = $reservation->updateReservationStatus($reservationId, Reservation::STATUS_PRETE);
        if ($updateReservation) {
            // Redirection vers la liste des documents après un prêt réussi
            return RequirePage::url("Document/list");
        } else {
            $errors[] = "Erreur lors du prêt du document. Veuillez réessayer.";
            return $this->list(null, $errors);
        }
    }
}