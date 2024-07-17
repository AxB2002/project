<div class="card">
    <div class="card-body">
        <h5 class="card-title">Créer un utilisateur</h5>

        <?php if (isset($success) && $success === true): ?>
        <div class="alert alert-success" role="alert">
            Utilisateur créé avec succès!
        </div>
        <?php endif; ?>

        <form method="post" action="<?= $path . "Utilisateur/store" ?>">
            <div class="row mb-3">
                <label for="prenom" class="col-sm-2 col-form-label">Prénom</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="prenom" name="Prenom" value="<?= isset($values['Prenom']) ? htmlspecialchars($values['Prenom']) : '' ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="nom" class="col-sm-2 col-form-label">Nom</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nom" name="Nom" value="<?= isset($values['Nom']) ? htmlspecialchars($values['Nom']) : '' ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="adresse" class="col-sm-2 col-form-label">Adresse</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="adresse" name="Adresse" value="<?= isset($values['Adresse']) ? htmlspecialchars($values['Adresse']) : '' ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="telephone" class="col-sm-2 col-form-label">Téléphone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telephone" name="Telephone" value="<?= isset($values['Telephone']) ? htmlspecialchars($values['Telephone']) : '' ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="courriel" class="col-sm-2 col-form-label">Courriel</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="courriel" name="Courriel" value="<?= isset($values['Courriel']) ? htmlspecialchars($values['Courriel']) : '' ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="mot_de_passe" class="col-sm-2 col-form-label">Mot de passe</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="mot_de_passe" name="Mot_De_Passe" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="role" class="col-sm-2 col-form-label">Rôle</label>
                <div class="col-sm-10">
                    <select class="form-select" id="role" name="Role" required>
                        <option value="" disabled <?= !isset($values['Role']) ? 'selected' : '' ?>>Choisir...</option>
                        <?php foreach($roles as $key => $value) { ?>
                        <option value="<?= $key ?>" <?= isset($values['Role']) && $values['Role'] == $key ? 'selected' : '' ?>><?= $value ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Soumettre</button>
            </div>
        </form>

    </div>
</div>