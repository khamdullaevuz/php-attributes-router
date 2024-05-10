<?php

namespace controllers;

use framework\Response;
use framework\Route;

class HomeController
{
    #[Route('/')]
    #[Route('/home')]
    public function __invoke(): Response
    {
        return new Response('Hello, world!');
    }

    #[Route('/about')]
    public function about(): Response
    {
        return new Response('About us');
    }
}