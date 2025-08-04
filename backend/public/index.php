<?php

require_once dirname(__DIR__, 1) . '/config/bootstrap.php';
require_once dirname(__DIR__, 1) . '/routes/web.php';


$router->dispatch();




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