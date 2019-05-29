<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;

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



}