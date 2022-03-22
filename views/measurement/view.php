<div class="row" style="margin-top: 10vh;">
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
        <a class="btn btn-default" href="index.php">Zurueck</a>
    </div>
</div>
</div>