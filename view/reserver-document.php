<div class="card">
    <div class="card-body">
        <h5 class="card-title">Réservation du Document</h5>

        <!-- Formulaire de réservation -->
        <form method="post" action="<?= $path . 'Document/reserver' ?>">
            <input type="hidden" name="document_id" value="<?= htmlspecialchars($document_id) ?>">

            <!-- Sélection de la date de retour prévue -->
            <div class="mb-3">
                <label for="date_retour" class="form-label">Date de retour prévue :</label>
                <input type="date" class="form-control" id="date_retour" name="date_retour" required>
            </div>

            <?php if ($user['Role'] == Utilisateur::ROLE_EMPLOYE || $user['Role'] == Utilisateur::ROLE_ADMIN) : ?>
            <!-- Sélection du membre -->
            <div class="mb-3">
                <label for="code_membre" class="form-label">Sélectionner le membre :</label>
                <select class="form-select" id="code_membre" name="code_membre" required>
                    <option value="">Choisir un membre</option>
                    <?php foreach ($membres as $membre) : ?>
                    <option value="<?= htmlspecialchars($membre['Code_Membre']) ?>">
                        <?= htmlspecialchars($membre['Nom']) ?> <?= htmlspecialchars($membre['Prenom']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">Réserver</button>
        </form>
    </div>
</div>