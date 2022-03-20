<?php

require_once('Controller.php');
require_once('models/Measurement.php');
require_once('models/Station.php');

class StationController extends Controller
{
    /**
     * @param $route array, e.g. [station, view]
     */
    public function handleRequest($route)
    {
        $operation = sizeof($route) > 1 ? $route[1] : 'index';
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        if ($operation == 'view') {
            $this->actionView($id);
        } elseif ($operation == 'update') {
            $this->actionUpdate($id);
        } elseif ($operation == 'delete') {
            $this->actionDelete($id);
        } else {
            Controller::showError("Page not found", "Page for operation " . $operation . " was not found!");
        }

    }

    public function actionIndex()
    {

        /*
        $model = Station::getAll();
        $this->render('station/index', $model);
        */
    }

    public function actionView($id)
    {
        $model = Station::get($id);
        $this->render('station/view', $model);
    }

    public function actionCreate()
    {

    }

    public function actionUpdate($id)
    {
    
        $model = Station::get($id);

        if (!empty($_POST)) {
            $model->setName($this->getDataOrNull('name'));
            $model->setAltitude($this->getDataOrNull('altitude'));
            $model->setLocation($this->getDataOrNull('location'));


            if ($model->save()) {
                $this->redirect('station/view&id=' . $model->getId());
                return;
            }
        }


        $this->render('station/update', $model);
    
    }


    public function actionDelete($id)
    {
    
        if (!empty($_POST)) {
            header("Location: https://www.google.at");
            Station::delete($id);
            $this->redirect('home/index');
            return;
        }

        $this->render('station/delete', Station::get($id));
    }

    

}
