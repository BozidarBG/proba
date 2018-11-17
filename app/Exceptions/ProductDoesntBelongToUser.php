<?php

namespace App\Exceptions;

use Exception;

class ProductDoesntBelongToUser extends Exception
{
    //
    public function render(){
        return ['error'=>'Product doesn\'t belong to you'];
    }
}
