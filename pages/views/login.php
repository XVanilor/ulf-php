<html lang="fr">

<?= layout("head", ["page_name" => "Connexion"]); ?>

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
                    <h1 class="h4 text-gray-900 mb-4">Connexion</h1>
                  </div>
                    <?= flash()->display() ?>
                  <form class="user" action="" method="POST">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="loginEmail" name="email" placeholder="Adresse e-mail..." />
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="loginPassword" name="password" placeholder="Mot de passe" />
                    </div>
					<hr>
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Connexion" />
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