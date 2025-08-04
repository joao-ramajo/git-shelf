<?php

namespace Api\Controllers;

class MainController
{
    public function index(){
        echo "home teste";
    }
    public function request(string $name, string $page): ?array
    {
        $token = $_ENV['GITHUB_TOKEN'];
        $appName = $_ENV['APP_NAME'];

        $perPage = 100;

        $options = [
            'http' => [
                'method' => "GET",
                'header' => "User-Agent: $appName\r\nAuthorization: token $token\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents("https://api.github.com/users/$name/repos?per_page=$perPage&page=$page", false, $context);
        $total = count(json_decode(file_get_contents("https://api.github.com/users/$name/repos?per_page=200", false, $context), true));
        $data = json_decode($response, true);

        $page = (int) $page;
        $hasNextPage =  count(json_decode(file_get_contents("https://api.github.com/users/$name/repos?per_page=$perPage&page=" . $page++, false, $context), true)) > 0;



        $return = [
            'data' => $data,
            'hasNextPage' => $hasNextPage,
            'page' => $page,
            'total_repositories' => $total
        ];
        return $return;
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

    public function json(array $params = [])
    {
        $name = $params['name'];
        $filters = [];
        $language = '';
        $page = '';

        if (is_null($name)) {
            echo "NOME NÂO PODE SER NULO";
            return;
        }
        $data = $this->request($name, $page);
        $default_filters = ['name', 'description', 'language'];

        if (!empty($filters)) {
            $filters = array_map(function ($string) {
                return trim($string);
            }, $filters);
            $data['data'] = $this->filter($filters, $data['data'], $language);
        } else {
            $data['data'] = $this->filter($default_filters, $data['data'], $language);
        }

        $res =  json_encode($data, JSON_PRETTY_PRINT);

        echo $res;
    }
}
