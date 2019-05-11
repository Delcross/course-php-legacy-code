<?php 
namespace Core;

class View
{
    private $v;
    private $t;
    private $data = [];

    public function __construct($v, $t = 'back')
    {
        $this->setView($v);
        $this->setTemplate($t);
    }

    public function __destruct()
    {
        extract($this->data);
        include $this->t;
    }
}

class Viewset
{
    public function setView($v)
    {
        $viewPath = 'views/'.$v.'.view.php';
        if (file_exists($viewPath)) {
            $this->v = $viewPath;
        } else {
            die("Attention le fichier view n'existe pas ".$viewPath);
        }
    }

    public function setTemplate($t)
    {
        $templatePath = 'views/templates/'.$t.'.tpl.php';
        if (file_exists($templatePath)) {
            $this->t = $templatePath;
        } else {
            die("Attention le fichier template n'existe pas ".$templatePath);
        }
    }
}

class Viewadd
{
    public function addModal($modal, $config)
    {
        $modalPath = 'views/modals/'.$modal.'.mod.php';
        if (file_exists($modalPath)) {
            include $modalPath;
        } else {
            die("Attention le fichier modal n'existe pas ".$modalPath);
        }
    }
}

class Viewassign
{
    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }
}