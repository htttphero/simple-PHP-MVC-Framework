<?php

namespace MyProject\Controllers;


use MyProject\Models\Articles\Article;
use MyProject\View\View;
use MyProject\Models\Users\User;



class ArticlesController extends AbstractController
{

     protected $view;

 

    // public function __construct()
    // {
    //     // $this->user = UsersAuthService::getUserByToken();
    //     // $this->view = new View(__DIR__ . '/../../../templates');
    //     // $this->view->setVar('user', $this->user);
     
    // }

    public function view(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new \MyProject\Exceptions\NotFoundException();
        }
        
        
        // $articleAuthor = User::getById($article->getAuthorId()); так как возвращаем автора полностью со статьи выше

        // $this->view->renderHtml('articles/view.php', ['article' => $article]); так как теперь передаем еще автора
        $this->view->renderHtml('articles/view.php', [
            'article' => $article,
        
        ]);
    }

    public function edit(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new \MyProject\Exceptions\NotFoundException();
        }
        $article->setName('Новое название статьи');
        $article->setText('Новый текст статьи');

        $article->save();

        var_dump($article);
    }

    public function add() 
    {
        $author = User::getById(1);

        $article = new Article();
        $article->setAuthor($author);
        $article->setName('Новое название статьи2');
        $article->setText('Новый текст статьи2');

        $article->save();
        echo "<pre>";
        var_dump($article);
        echo "</pre>";
    }

    public function delete(int $articleId)
    {
        $article = Article::getById($articleId);
        if ($article === null) {
            throw new \MyProject\Exceptions\NotFoundException();
       
        }
        $article->delete();
    }

}