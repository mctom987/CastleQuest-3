<?php

class DashboardController extends Cq_Controller
{
    public function indexAction()
    {
        $this->view->headTitle('Dashboard');
    }
}