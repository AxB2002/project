<div class="card">
    <div class="card-body">
        <h5 class="card-title">Liste des Réservations</h5>

        <form method="post" action="<?= $path . "Reservation/list" ?>">
            <div class="row mb-3">
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="search" placeholder="Recherche par titre, auteur ou utilisateur" value="<?= htmlspecialchars($search) ?>">
                </div>
                <div class="col-sm-4">
                    <select class="form-select" name="status">
                        <option value="">Tous les statuts</option>
                        <option value="prete" <?= $statusFilter == 'prete' ? 'selected' : '' ?>>Prêté</option>
                        <option value="annule" <?= $statusFilter == 'annule' ? 'selected' : '' ?>>Annulé</option>
                        <option value="termine" <?= $statusFilter == 'termine' ? 'selected' : '' ?>>Terminé</option>
                        <option value="reserve" <?= $statusFilter == 'reserve' ? 'selected' : '' ?>>Réservé</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="overdue" id="overdue" <?= $overdueOnly ? 'checked' : '' ?>>
                        <label class="form-check-label" for="overdue">
                            Réservations en retard
                        </label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Code Document</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Nom Utilisateur</th>
                    <th scope="col">Date de Réservation</th>
                    <th scope="col">Date de Retour</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($reservations as $reservation) { ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($reservation['Code_Document']) ?></th>
                    <td><?= htmlspecialchars($reservation['Titre']) ?></td>
                    <td><?= htmlspecialchars($reservation['Auteur']) ?></td>
                    <td><?= htmlspecialchars($reservation['Nom_Utilisateur']) ?></td>
                    <td><?= htmlspecialchars($reservation['Date_Reservation_Debut']) ?></td>
                    <td><?= htmlspecialchars($reservation['Date_Reservation_Retour']) ?></td>
                    <td><?= htmlspecialchars($reservation['Status']) ?></td>
                    <td>
                        <?php if ($reservation['Status'] == 'reserve') : ?>
                        <form method="post" action="<?= $path . 'Reservation/annuler' ?>">
                            <input type="hidden" name="reservation_id" value="<?= htmlspecialchars($reservation['Reservation_ID']) ?>">
                            <button type="submit" class="btn btn-danger">Annuler</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>