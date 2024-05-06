<?php

namespace controllers;

use framework\Response;
use framework\Route;

class TaskController
{
    #[Route('/tasks')]
    public function index(): Response
    {
        return new Response('List of tasks');
    }

    #[Route('/tasks/create')]
    public function create(): Response
    {
        return new Response('Create a task');
    }
}