<?php

namespace PascaleBeier\CSRF;

class Field
{
    protected $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function generate()
    {
        $this->token->generate();

        return '<input type="hidden" name="csrf_token" value="'.$this->token->getToken().'">';
    }
}
