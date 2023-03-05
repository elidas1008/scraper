<?php

namespace Elidas1008\Scraper;

class Scraper
{
    private string $dom;

    public function __construct()
    {

    }

    public function go(string $address, array $args = []): static
    {
        $this->dom = $address;
        return $this;
    }

    public function get(string $query): string
    {
        return $this->dom;
    }
}