<?= controller("HomeB"); ?>

<!DOCTYPE html>
<html wtx-context="9D8095EB-E564-4336-8897-EB2D2D3DD588" lang="en">

    <?= layout("head"); ?>

    <body id="page-top" style="background-color: #000000">

        <!-- Header -->
        <header class="masthead d-flex" style="background-image: url('<?= assets("img/banner_dark.jfif")?>') !important;
                color: #ffffff;
                font-size: 20px; !important" >
            <div class="container text-center my-auto">
                <h1 class="mb-1">Ultra-Light Framework</h1>
                <h3 class="mb-5">
                    <em>Yay ! You successfully instanciated the U-LF, let's enjoy !</em>
                </h3>
            </div>
            <div class="overlay"></div>
        </header>

        <!-- Footer -->
        <footer class="footer text-center">
            <div class="container">
                <ul class="list-inline mb-5">
                    <li class="list-inline-item">
                        <a style="background-color: rgb(255,255,255);
                                  background-image: url('<?= assets("/img/gitlab_logo.png"); ?>');
                                  background-size: 80px 80px;
                                  background-repeat: no-repeat;
                                  background-position: center;"
                           class="social-link rounded-circle text-white mr-3"
                           href="https://gitlab.com/Vanilor/ulf-php"
                           target="_blanck">
                        </a>
                    </li>
                </ul>
                <p class="text-muted small mb-0">Created and maintained by <a href="https://vanilor.info">Vanilor</a></p>
            </div>
        </footer>

        <a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <?= layout('scripts'); ?>

    </body>
</html>