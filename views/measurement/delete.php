<div class="container">
    <div class="row">
        <h2>Messwert bearbeiten</h2>
    </div>



    <form class="form-horizontal" action="index.php?r=measurement/delete&id=<?= $model->getId() ?>" method="post">



        <div class="form-group">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Messwert</th>
                    </tr>
                    </thead>

                    <tbody id="measurements">
                        <tr><td><?= $model->getTime() ?></td></tr>
                        <tr><td><?= $model->getTemperature() ?></td></tr>
                        <tr><td><?= $model->getRain() ?></td></tr>
                        <tr><td><?= Station::get($model->getStationId())->getName() ?></td></tr>
                    </tbody>
                </table>

                <button name="submit" value="1" type="submit" class="btn btn-primary">Leoschen</button>
                <a class="btn btn-default" href="index.php">Abbruch</a>
            </div>
            <div class="col-md-4"></div>
            
        </div>
    </form>

</div> <!-- /container -->
