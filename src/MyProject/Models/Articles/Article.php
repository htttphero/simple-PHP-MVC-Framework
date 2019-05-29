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
    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

}