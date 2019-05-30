<?php

namespace MyProject\Models\Users;

use MyProject\Services\Db;

// специальный сервис, который позволит нам создавать новые коды активации для пользователей, а также проверять код активации для конкретного пользователя. 
class UserActivationService
{
    

    public static function createActivationCode(User $user): string
    {
        // Генерируем случайную последовательность символов, о функциях почитайте в документации
        $code = bin2hex(random_bytes(16));

        $db = Db::getInstance();
        $db->query(
            'INSERT INTO ' . 'users_activation_codes'. ' (user_id, code) VALUES (:user_id, :code)',
            [
                'user_id' => $user->getId(),
                'code' => $code
            ]
        );

        return $code;
    }

    public static function checkActivationCode(User $user, string $code): bool
    {
        $db = Db::getInstance();
        $result = $db->query(
            'SELECT * FROM ' . 'users_activation_codes'. ' WHERE user_id = :user_id AND code = :code',
            [
                'user_id' => $user->getId(),
                'code' => $code
            ]
        );
        return !empty($result);
    }
}