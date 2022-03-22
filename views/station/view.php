<div class="container">
    <h2>Messstation anzeigen</h2>

    <p>
        <a class="btn btn-primary" href="index.php?r=station/update&id=<?= $model->getId() ?>">Aktualisieren</a>
        <a class="btn btn-danger" href="index.php?r=station/delete&id=<?= $model->getId() ?>">Löschen</a>
        <a class="btn btn-default" href="index.php">Zurück</a>
    </p>









        <div class="container">
        <div class="row">
            <div class="col-8">
          
            <table class="table table-striped table-bordered detail-view">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td><?= $model->getName() ?></td>
                    </tr>
                    <tr>
                        <th>Höhe</th>
                        <td><?= $model->getAltitude() ?> m</td>
                    </tr>
                    <tr>
                        <th>Ort</th>
                        <td><a target="_blank" href="https://www.google.at/maps/@<?= $model->getLocation() ?>,15z"><?= $model->getLocation() ?></a></td>
                    </tr>
                </tbody>
            </table>


            </div>
            <div class="col-4">
            
            
            <iframe 
            width="300" 
            height="150" 
            frameborder="0" 
            scrolling="no" 
            marginheight="0" 
            marginwidth="0" 
            src="https://maps.google.com/maps?q=<?= $model->getLocation() ?>&hl=de&z=14&amp;output=embed"
            >
            </iframe>



            </div>
        </div>
        </div>




</div> <!-- /container -->
