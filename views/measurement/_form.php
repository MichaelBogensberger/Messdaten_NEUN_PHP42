<div class="row">
    <div class="col-md-3">
        <div class="form-group required <?= $model->hasError('name') ? 'has-error' : ''; ?>">
            <label class="control-label">Time *</label>
            <input type="text" class="form-control" name="time" value="<?= $model->getTime() ?>">

            <?php if ($model->hasError('time')): ?>
                <div class="help-block"><?= $model->getError('time') ?></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group required <?= $model->hasError('location') ? 'has-error' : ''; ?>">
            <label class="control-label">Temperatur *</label>
            <input type="text" class="form-control" name="temperature" value="<?= $model->getTemperature() ?>">

            <?php if ($model->hasError('location')): ?>
                <div class="help-block"><?= $model->getError('temperature') ?></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group required <?= $model->hasError('altitude') ? 'has-error' : ''; ?>">
            <label class="control-label">Rain *</label>
            <input type="text" class="form-control" name="rain" value="<?= $model->getRain() ?>">

            <?php if ($model->hasError('rain')): ?>
                <div class="help-block"><?= $model->getError('rain') ?></div>
            <?php endif; ?>
        </div>
    </div>



    <div class="col-md-3">
        <div class="form-group required <?= $model->hasError('altitude') ? 'has-error' : ''; ?>">
            <label class="control-label">Station *</label>

            <select class="form-control"   name="station_id" style="width: 200px">
            <?php
                $stations = Station::getAll();
                $currentStation = Station::get($model->getStationId());

                echo '<option value="' . $currentStation->getId() . '">' . $currentStation->getName() . ' - ' . $currentStation->getId() . '</option>';

                foreach($stations as $station):
                    if($station != $currentStation)
                        echo '<option value="' . $station->getId() . '">' . $station->getName() . ' - ' . $station->getId() . '</option>';
                endforeach;
            ?>
            </select>

        </div>
    </div>


</div>
