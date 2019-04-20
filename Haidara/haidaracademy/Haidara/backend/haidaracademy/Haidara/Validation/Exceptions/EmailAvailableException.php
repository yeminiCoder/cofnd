<?php
namespace Haidara\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class EmailAvailableException extends ValidationException
{

    public static $defaultTemplates =[

        self::MODE_DEFAULT =>[
            self::STANDARD  =>' cet email est déjà pris!'
        ]


    ];

}














































?>