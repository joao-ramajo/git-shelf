<?php

require_once dirname(__DIR__, 1) . '/config/bootstrap.php';

use Api\Controllers\MainController;

$controller = new MainController();

$name = isset($_GET['name']) ? $_GET['name'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
$filters = isset($_GET['filters']) ? $_GET['filters'] : '';
$language = isset($_GET['language']) ? $_GET['language'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : '';


function convertToArray(string $filters)
{
    if (empty($filters)) {
        return [];
    }
    $arr = explode(',', $filters);

    return $arr;
}

convertToArray($filters);

switch ($action) {
    case 'json':
        echo $controller->json($name, convertToArray($filters), $language, $page);
        break;
    default:
        echo "";
        break;
}



// name	Nome do repositório
// html_url	URL pública para acessar o repositório
// description	Descrição curta do projeto (você define no GitHub)
// language	Linguagem principal detectada (ex: PHP, JavaScript, etc.)
// created_at	Data de criação
// updated_at	Última atualização
// pushed_at	Último push (commit)
// topics	Lista de tags que você adicionou no repositório
// stargazers_count	Quantidade de estrelas recebidas
// forks_count	Quantidade de forks
// watchers_count	Quantidade de watchers
// homepage	URL de demo ou deploy (ex: vercel, netlify, etc.)
// visibility	Se é público ou privado (deve ser "public" para exibir no portfólio)
// license	Informações de licença, se houver
// owner.avatar_url	URL da imagem de perfil (caso queira exibir junto)