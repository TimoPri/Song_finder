<?php
include_once('header.php');

?>
<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1>Songfinder</h1>
            <p class="lead text-muted">Liederdatenbank der ECGB</p>
            <p>
            </p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img width="100%"
                             src="https://i.pinimg.com/564x/04/a3/d9/04a3d98d43417dd93626d9e2f3f1949a.jpg"/>
                        <div class="card-body">
                            <p class="card-text">Songdatenbank ohne Anmeldung</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a type="button" class="btn btn-sm btn-outline-secondary" href="basicsongs.php">Ansehen</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img width="100%"
                             src="https://i.pinimg.com/564x/04/a3/d9/04a3d98d43417dd93626d9e2f3f1949a.jpg"/>
                        <div class="card-body">
                            <p class="card-text">Songdatenbank mit Anmeldung</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a type="button" class="btn btn-sm btn-outline-secondary" href="detailedsongs.php">Ansehen</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</main>

