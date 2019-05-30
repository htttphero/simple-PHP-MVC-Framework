<?php
namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\View\View;
use MyProject\Services\UsersAuthService;
// use MyProject\Services\Db;

class MainController extends AbstractController
{
    //   protected  $view;
    private $db;
    // public function __construct()
    // {

    // }

    public function main()
    {   //закоментировал так как начал использовать реальное соединение с базой данныз и получие данных из нее
        //     $articles = [
        //     ['name' => 'Статья 1', 'text' => 'Текст статьи 1'],
        //     ['name' => 'Статья 2', 'text' => 'Текст статьи 2'],
        // ];
 
        // $this->view->renderHtml('main/main.php', ['articles' => $articles]);
        // $articles = $this->db->query('SELECT * FROM `articles`;');

        ////// возвращает обьекс класса с помощью PDO
        // $articles = $this->db->query('SELECT * FROM `articles`;', [], Article::class);
        $articles = Article::findAll();
        $this->view->renderHtml('main/main.php', [
            'articles' => $articles,
           
            // получаем из абстрактного контроллера
            //  'user' => UsersAuthService::getUserByToken()
            ]);
    }

    public function sayHello(string $name)
    {
        $this->view->renderHtml('main/hello.php', ['name' => $name]);
    }

  
}