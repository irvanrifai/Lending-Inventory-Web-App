<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="row">
            <div class="col">
                <a class="navbar-brand" href="/"><img src="/img/LOGO-FKI-baru.png" width="110" height="115" alt class="img-fluid"></a>
                <a class="navbar-brand" href="/"><b>SPOKI UMS</b>
                </a>
            </div>
        </div>
        <div class="row">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" ng-controller="HeaderController">
                <ul class="navbar-nav me-8">
                    <li class="nav-item ini">
                        <a class="nav-link" href="/"><b>Home</b></a>
                    </li>
                    <li class="nav-item ini">
                        <a class="nav-link" href="/pages/inventaris"><b>Inventaris</b></a>
                    </li>
                    <li class="nav-item ini">
                        <a class="nav-link" href="/pages/pinjam"><b>Pinjam</b></a>
                    </li>
                    <!-- unread apik -->
                    <!-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        99+
                        <span class="visually-hidden">unread messages</span>
                    </span> -->
                    <?php if (in_groups('adm_bem')) : ?>
                        <li class="nav-item ini">
                            <a class="nav-link" href="/pages/admin/adm_bem"><b>Admin</b></a>
                        </li>
                    <?php elseif (in_groups('adm_dpm')) : ?>
                        <li class="nav-item ini">
                            <a class="nav-link" href="/pages/admin/adm_dpm"><b>Admin</b></a>
                        </li>
                    <?php elseif (in_groups('adm_lpm')) : ?>
                        <li class="nav-item ini">
                            <a class="nav-link" href="/pages/admin/adm_lpm"><b>Admin</b></a>
                        </li>
                    <?php elseif (in_groups('adm_himatif')) : ?>
                        <li class="nav-item ini">
                            <a class="nav-link" href="/pages/admin/adm_himatif"><b>Admin</b></a>
                        </li>
                    <?php elseif (in_groups('adm_himakom')) : ?>
                        <li class="nav-item ini">
                            <a class="nav-link" href="/pages/admin/adm_himakom"><b>Admin</b></a>
                        </li>
                    <?php elseif (in_groups('adm_finic')) : ?>
                        <li class="nav-item ini">
                            <a class="nav-link" href="/pages/admin/adm_finic"><b>Admin</b></a>
                        </li>
                    <?php elseif (in_groups('adm_kine')) : ?>
                        <li class="nav-item ini">
                            <a class="nav-link" href="/pages/admin/adm_kine"><b>Admin</b></a>
                        </li>
                    <?php elseif (in_groups('adm_fosti')) : ?>
                        <li class="nav-item ini">
                            <a class="nav-link" href="/pages/admin/adm_fosti"><b>Admin</b></a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item ms-2 ini">
                        <?php if (logged_in()) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle bi bi-person-check-fill btn btn-outline-secondary" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= user()->username; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item btn btn-danger tooltip-test" href="/logout" title="Logout Admin">Logout</a></li>
                        </ul>
                    </li>
                    <!-- <a class="btn btn-danger bi bi-person-circle tooltip-test" title="Logout Admin" href="/logout"> Logout</a> -->
                <?php else : ?>
                    <a class="btn btn-primary bi bi-person tooltip-test" title="Login Admin" href="/login"> Login</a>
                <?php endif; ?>
                </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<br>