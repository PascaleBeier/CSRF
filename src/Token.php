<?php

namespace PascaleBeier\CSRF;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class Token
{
    protected $token;
    protected $session;
    protected $request;

    public function __construct(Session $session, Request $request)
    {
        $this->session = $session;
        $this->request =  $request;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    public function generate()
    {
        if (!$this->session->has('csrf_token')) {
            $this->token = bin2hex(random_bytes(32));
            return $this->session->set('csrf_token', $this->token);
        }
        return $this->token = $this->session->get('csrf_token');
    }

    public function matches()
    {
        return $this->session->get('csrf_token') === $this->request->get('csrf_token');
    }
}
