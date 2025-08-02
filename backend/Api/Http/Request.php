<?php

namespace Api\Http;

class Request
{
    private array $query;

    public function __construct(array $query)
    {
        foreach($query as $key => $value){
            $query[$key] = htmlspecialchars($value,  ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        }
        $this->query = $query;
    }

    public function __get($key){
        return $this->query[$key];
    }

    public function get(string $key, $default = '')
    {
        return $this->query[$key] ?? $default;
    }

    public function getFilters(): array
    {
        $filters = $this->get('filters', '');
        if (empty($filters)) {
            return [];
        }
        return explode(',', $filters);
    }
}
