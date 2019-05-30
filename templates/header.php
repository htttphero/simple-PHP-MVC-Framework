<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой блог</title>
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header">
            Мой блог
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right">
            <?= !empty($user) ? 'Привет, ' . $user->getNickname() .' |'.'<a href="eexit"> Выйти<a>'  : 'Войдите на сайт' ?>
        </td>
    </tr>
    <tr>
        <td>