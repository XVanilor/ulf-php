<html lang="fr">

    <?= layout("head", ["page_name" => "Inscription"]); ?>

    <body class="bg-gradient-primary">

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <img class="img-fluid col-lg-5" src="<?= assets('img/cafe.jpeg'); ?>" />
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Inscription</h1>
                                        </div>
                                        <?= flash()->display() ?>
                                        <form class="user" action="<?= $routes["/register"]; ?>" method="POST">
                                            <div class="form-group form-inline">
                                                <input type="text" class="form-control form-control-user col-5"
                                                       id="last_name" name="last_name"
                                                       placeholder="Nom" />
                                                <span class="col-2"></span>
                                                <input type="text" class="form-control form-control-user col-5"
                                                       id="first_name" name="first_name"
                                                       placeholder="Prénom" />
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user"
                                                       id="email" name="email"
                                                       placeholder="Adresse e-mail..." />
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                       id="password" name="password"
                                                       placeholder="Mot de passe" />
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                       id="password_confirm" name="password_confirm"
                                                       placeholder="Confirmez le mot de passe" />
                                            </div>
                                            <hr>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">Inscription</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <?= layout("scripts"); ?>

    </body>
</html>
