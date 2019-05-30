<?php

namespace MyProject\Controllers;


use MyProject\Models\Articles\Article;
use MyProject\View\View;
use MyProject\Models\Users\User;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Exceptions\InvalidArgumentException;



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

        if ($this->user === null) {
            throw new \MyProject\Exceptions\UnauthorizedException();
        }

        if (!empty($_POST)) {
            try {
                $article->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php', ['error' => $e->getMessage()]);
                return;
            }
    
            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }
    
        $this->view->renderHtml('articles/edit.php', ['article' => $article]);

        // $article->setName('Новое название статьи');
        // $article->setText('Новый текст статьи');

        // $article->save();

        // var_dump($article);
    }

    public function add() 
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }
    
        if (!empty($_POST)) {
            try {
                $article = Article::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }
    
            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php');
        return; 
        // $author = User::getById(1);

        // $article = new Article();
        // $article->setAuthor($author);
        // $article->setName('Новое название статьи2');
        // $article->setText('Новый текст статьи2');

        // $article->save();
        // echo "<pre>";
        // var_dump($article);
        // echo "</pre>";
    }

    public function delete(int $articleId)
    {
        $article = Article::getById($articleId);
        if ($article === null) {
            throw new \MyProject\Exceptions\NotFoundException();
       
        }
        header('Location: /');
        $article->delete();

    }

    

}