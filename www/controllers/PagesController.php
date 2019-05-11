<?php 
namespace Controllers;
use Core\View;

class PagesController
{
    public function defaultAction()
    {
        $view = new Viewassign('homepage', 'back');
        $view->assign('pseudo', 'prof');
    }
}
