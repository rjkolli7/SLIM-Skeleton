<?php

namespace AndroidIM\Validation\Rules;

use AndroidIM\Models\User;
use Respect\Validation\Rules\AbstractRule;

class EmailAvailable extends AbstractRule{


public  function validate($input)
{

    return User::where('email', $input)->count() === 0;

}


}