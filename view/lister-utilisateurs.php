<div class="card">
    <div class="card-body">
        <h5 class="card-title">Liste Utilisateurs</h5>

        <!-- Formulaire de recherche -->
        <form method="post" action="<?= $path . "Utilisateur/list" ?>">
            <div class="row mb-3">
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="search" placeholder="Recherche par prénom, nom, adresse, téléphone ou courriel" value="<?= htmlspecialchars($search) ?>">
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
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Courriel</th>
                    <th scope="col">Rôle</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $userList) {
                        ?>
                <tr>
                    <th scope="row"><?= $userList['Code_Membre'] ?></th>
                    <td><?= $userList['Prenom'] ?></td>
                    <td><?= $userList['Nom'] ?></td>
                    <td><?= $userList['Adresse'] ?></td>
                    <td><?= $userList['Telephone'] ?></td>
                    <td><?= $userList['Courriel'] ?></td>
                    <td><?= $userList['Role'] ?></td>
                    <td>
                        <?php if ($user['Role'] == Utilisateur::ROLE_ADMIN) : ?>
                        <form method="post" action="<?= $path . "Utilisateur/delete" ?>">
                            <input type="hidden" name="Code_Membre" value="<?= $userList['Code_Membre'] ?>" />
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php
                    } ?>
            </tbody>
        </table>
    </div>
</div>