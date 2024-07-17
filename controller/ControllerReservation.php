<?php

requirePage::model('CRUD');
requirePage::model('Reservation');
requirePage::model('Utilisateur');
requirePage::library('Validation');
// require_once('controller/ControllerAdmin.php');

class ControllerReservation extends Controller {
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
        $reservation = new Reservation;

        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $statusFilter = isset($_POST['status']) ? $_POST['status'] : '';
        $overdueOnly = isset($_POST['overdue']) ? true : false; // Ajout du filtre pour les réservations en retard

        $reservations = $reservation->searchReservations($search, $statusFilter, $overdueOnly);

        return Template::render('lister-reservations', [
            'reservations' => $reservations,
            'search' => $search,
            'statusFilter' => $statusFilter,
            'overdueOnly' => $overdueOnly, // Passage du statut du filtre à la vue
        ], $errors);
    }
    
    public function annuler() {
        $reservationId = isset($_POST['reservation_id']) ? $_POST['reservation_id'] : null;
        $reservation = new Reservation;

        // Vérifier si l'utilisateur a le droit d'annuler la réservation (par exemple, rôle employé ou admin)
        $user = $_SESSION['oUtilConn'];
        if (!isset($user['Code_Membre'])) {
            $errors[] = "Vous devez être connecté pour annuler une réservation.";
            return $this->list(null, $errors);
        }

        // Effectuer l'annulation de la réservation
        $annulationSuccess = $reservation->annulerReservation($reservationId);

        if ($annulationSuccess) {
            $success[] = "La réservation a été annulée avec succès.";
        } else {
            $errors[] = "Erreur lors de l'annulation de la réservation. Veuillez réessayer.";
        }

         return RequirePage::url("Reservation/list");
    }
}