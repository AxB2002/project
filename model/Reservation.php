<?php

class Reservation extends CRUD {
    protected $table = 'reservation';
    protected $primaryKey = 'Reservation_ID';

    protected $fillable = [
        'Reservation_ID',
        'Code_Document',
        'Code_Membre',
        'Status',
        'Date_Reservation_Debut',
        'Date_Reservation_Retour'
    ];

    const STATUS_RESERVE = 'reserve';
    const STATUS_PRETE = 'prete';
    const STATUS_ANNULE = 'annule';
    const STATUS_TERMINE = 'termine';

    public function checkReservation($reservationId) {
        $sql = "SELECT * FROM $this->table WHERE Reservation_ID = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute([$reservationId]);
        $count = $stmt->rowCount();

        if ($count === 1) {
            $reservation_info = $stmt->fetch();
            return $reservation_info;
        } else {
            return "Réservation non trouvée";
        }
    }

    public function searchReservations($search, $statusFilter, $overdueOnly = false) {
        $sql = "SELECT r.*, d.Titre, d.Auteur, CONCAT(u.Prenom, ' ', u.Nom) AS Nom_Utilisateur
                FROM $this->table r
                JOIN Document d ON r.Code_Document = d.Code_Document
                JOIN Utilisateur u ON r.Code_Membre = u.Code_Membre
                WHERE (d.Titre LIKE ? OR d.Auteur LIKE ? OR u.Nom LIKE ? OR u.Prenom LIKE ?)";

        $params = ["%$search%", "%$search%", "%$search%", "%$search%"];

        if ($statusFilter) {
            $sql .= " AND r.Status = ?";
            $params[] = $statusFilter;
        }

        if ($overdueOnly) {
            $sql .= " AND ((r.Status = 'reserve' OR r.Status = 'prete') AND r.Date_Reservation_Retour < CURDATE())";
        }

        $stmt = $this->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function annulerReservation($reservationId) {
        $sql = "UPDATE $this->table SET Status = 'annule' WHERE Reservation_ID = ?";
        $stmt = $this->prepare($sql);
        return $stmt->execute([$reservationId]);
    }

    public function terminerReservation($reservationId) {
        $sql = "UPDATE $this->table SET Status = 'termine' WHERE Reservation_ID = ?";
        $stmt = $this->prepare($sql);
        return $stmt->execute([$reservationId]);
    }

    public function updateReservationStatus($reservationId, $newStatus) {
        $sql = "UPDATE $this->table SET Status = ? WHERE Reservation_ID = ?";
        $stmt = $this->prepare($sql);
        return $stmt->execute([$newStatus, $reservationId]);
    }
}

?>