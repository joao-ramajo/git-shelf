<?php

namespace Api\Controllers;



class MainController
{
    public function request(string $name): ?array
    {
        $token = $_ENV['GITHUB_TOKEN'];
        $appName = $_ENV['APP_NAME'];

        $options = [
            'http' => [
                'method' => "GET",
                'header' => "User-Agent: $appName\r\nAuthorization: token $token\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("https://api.github.com/users/$name/repos?per_page=100", false, $context);
        $data = json_decode($response, true);

        return $data;
    }

    public function filter(array $filters, array $data, string $language = ''): ?array
    {

        if (empty($filters) || is_null($data)) {
            return null;
        }
        $labels = $filters;
        $content = [];

        foreach ($data as $repo) {
            $arr = [];

            foreach ($repo as $key => $value) {
                if (!$language) {
                    if (in_array($key, $labels)) {

                        $arr[$key] = isset($value) ? $value : '';
                    }
                } else {
                    if ($repo['language'] == $language) {
                        if (in_array($key, $labels)) {

                            $arr[$key] = isset($value) ? $value : '';
                        }
                    }
                }
            }
            if (count($arr) > 0) {
                $content[] = $arr;
            }
        }

        for ($i = 0; $i < count($content); $i++) {
            $content[$i]['id'] = $i;
        }

        return $content;
    }

    public function save(array $data, string $filename): void
    {
        $json = json_encode($data, JSON_PRETTY_PRINT);

        $file = fopen($filename, 'w');
        fwrite($file, $json);
        fclose($file);
    }

    public function json(string $name, array $filters = [], string $language = '')
    {
        if (is_null($name)) {
            echo "NOME NÂO PODE SER NULO";
            return;
        }
        $data = $this->request($name);
        $default_filters = ['name', 'description', 'home_url'];

        if (!empty($filters)) {
            $filters = array_map(function ($string) {
                return trim($string);
            }, $filters);
            $data = $this->filter($filters, $data, $language);
        } else {
            $data = $this->filter($default_filters, $data, $language);
        }

        return json_encode($data, JSON_PRETTY_PRINT);
    }
}
