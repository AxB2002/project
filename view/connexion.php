<div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h4 class="card-subtitle text-center pb-0 fs-4">Bienvenue sur MaBiblioTech, retrouvez tout vos documents en un seul endroit</h4>
                            </div>

                            <form class="row g-3 needs-validation" method="post" action="<?= $path . "Connexion/auth" ?>">

                                <div class="col-12">
                                    <label for="Courriel" class="form-label">Courriel</label>
                                    <input type="text" name="Courriel" class="form-control" id="Courriel" required>
                                </div>

                                <div class="col-12">
                                    <label for="Mot_De_Passe" class="form-label">Mot de passe</label>
                                    <input type="password" name="Mot_De_Passe" class="form-control" id="Mot_De_Passe" required>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Connexion</button>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</div>