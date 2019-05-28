<?php
namespace MyProject\Controllers;

use MyProject\View\View;
use MyProject\Services\Db;

class MainController
{
    private $view;
    private $db;
    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->db = new Db();
    }

    public function main()
    {   //закоментировал так как начал использовать реальное соединение с базой данныз и получие данных из нее
        //     $articles = [
        //     ['name' => 'Статья 1', 'text' => 'Текст статьи 1'],
        //     ['name' => 'Статья 2', 'text' => 'Текст статьи 2'],
        // ];
 
        // $this->view->renderHtml('main/main.php', ['articles' => $articles]);
        $articles = $this->db->query('SELECT * FROM `articles`;');
        $this->view->renderHtml('main/main.php', ['articles' => $articles]);
    }

    public function sayHello(string $name)
    {
        $this->view->renderHtml('main/hello.php', ['name' => $name]);
    }

  
}