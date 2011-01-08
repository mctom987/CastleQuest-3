<?php

class AnnouncementsController extends Cq_LoginController
{
    protected $checkAuth = FALSE;
    
    public function indexAction()
    {
        $this->view->headTitle('Castle Quest 3');
        $this->view->pageTitle($this->view->translate('announcementsTitle'));
        $dao = new Model_Dao_Announcement;
        $this->view->announcements = $dao->findTopLevel();
    }
}