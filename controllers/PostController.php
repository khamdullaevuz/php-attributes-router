<?php

namespace controllers;

use framework\Response;

class PostController
{
    public function index(): Response
    {
        return new Response('List of posts');
    }

    public function create(): Response
    {
        return new Response('Create a post');
    }
}