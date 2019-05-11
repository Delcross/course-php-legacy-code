<?php 
namespace Controllers;
use Core\View;

class PagesController
{
    public function defaultAction()
    {
        $v = new Viewassign('homepage', 'back');
        $v->assign('pseudo', 'prof');
    }
}
