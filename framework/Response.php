<?php

namespace framework;

class Response
{
    public function __construct(
        public array|string $data,
        public int $status = 200,
        public array $headers = []
    )
    {
    }

    public function getStatusCode(): int
    {
        return $this->status;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function send(): false|array|string
    {
        return is_array($this->data) ? json_encode($this->data) : $this->data;
    }
}