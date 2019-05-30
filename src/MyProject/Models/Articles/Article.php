<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;

class Article  extends ActiveRecordEntity
{
    ////свойства обьявле
    protected $name;

 
    protected $text;

 
    protected $authorId;

 
    protected $createdAt;  

    
    public function getName(): string
    {
        return $this->name;
    }

 
    public function getText(): string
    {
        return $this->text;
    }

    protected static function getTableName(): string
    {
        return 'articles';
    }

    public function getAuthorId(): int
    {
        return (int) $this->authorId;
    }

    public function setName($name): string
    {
        return $this->name = $name;
    }

    public function setText($text): string
    {
        return $this->text = $text;
    }

    //возвращаем с модели Артикл полностью модель юзера по ID; 
    public function getAuthor()
    {
        return User::getById($this->authorId);
    }

    public function setAuthor(User $author) 
    {
        $this->authorId = $author->getId();
    }

    public static function createFromArray(array $fields, User $author): Article
{
    if (empty($fields['name'])) {
        throw new InvalidArgumentException('Не передано название статьи');
    }

    if (empty($fields['text'])) {
        throw new InvalidArgumentException('Не передан текст статьи');
    }

    $article = new Article();

    $article->setAuthor($author);
    $article->setName($fields['name']);
    $article->setText($fields['text']);

    $article->save();

    return $article;
}

}