<div class="card">
    <div class="card-body">
        <h5 class="card-title">Liste des Documents</h5>

        <form method="post" action="<?= $path . "Document/list" ?>">
            <div class="row mb-3">
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="search" placeholder="Recherche par titre ou auteur" value="<?= htmlspecialchars($search) ?>">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Année de Production</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Type</th>
                    <th scope="col">Genre</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($documents as $document) { ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($document['Code_Document']) ?></th>
                    <td><?= htmlspecialchars($document['Titre']) ?></td>
                    <td><?= htmlspecialchars($document['Auteur']) ?></td>
                    <td><?= htmlspecialchars($document['AnneeProduction']) ?></td>
                    <td><?= htmlspecialchars($document['Categorie']) ?></td>
                    <td><?= htmlspecialchars($document['Type']) ?></td>
                    <td><?= htmlspecialchars($document['Genre']) ?></td>
                    <td><?= htmlspecialchars($document['ISBN']) ?></td>
                    <td>
                        <?php if ($document['Etat_Reservation'] == 'non réservé') : ?>
                        <form method="post" action="<?= $path . 'Document/afficherFormulaireReservation' ?>">
                            <input type="hidden" name="document_id" value="<?= htmlspecialchars($document['Code_Document']) ?>">
                            <button type="submit" class="btn btn-success">Réserver</button>
                        </form>
                        <?php elseif ($document['Etat_Reservation'] == 'réservé') : ?>
                            <?php if ($user['Role'] == Utilisateur::ROLE_ADMIN || $user['Role'] == Utilisateur::ROLE_EMPLOYE) : ?>
                        <form method="post" action="<?= $path . 'Document/pretDocument' ?>">
                            <input type="hidden" name="document_id" value="<?= htmlspecialchars($document['Code_Document']) ?>">
                            <input type="hidden" name="reservation_id" value="<?= htmlspecialchars($document['Reservation_ID']) ?>">
                            <button type="submit" class="btn btn-warning">Faire un prêt</button>
                        </form>
                        <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>