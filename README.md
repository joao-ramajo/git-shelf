# 🧭 Git Shelf
*Alpine.js, Tailwind, PHP, APIs, Docker*


Este projeto é uma aplicação em duas partes: o frontend e o backend separados.

O backend é uma API em PHP para consulta de informações de perfis do GitHub, como número de repositórios públicos e seus detalhes. 

O frontend é uma interface feita com Alpine.js e Tailwind.

O Alpine.js foi escolhido por fornecer interatividade e reatividade em tempo de execução sem a necessidade de dependências pesadas ou alto nível de complexidade.

Tailwind foi escolhido para estilização por permitir um fluxo de desenvolvimento contínuo sem a necessidade de grande atenção a dezenas de arquivos CSS.

O frontend consome a API em PHP enviando o nome de usuário de um perfil do GitHub e recebe de volta um conjunto de informações do perfil e apresenta ao usuário.

---

## 💻 Tecnologias Utilizadas

- PHP 
- Alpine
- Tailwind
- Fetch JavaScript
- Docker 
---

## ✨ Funcionalidades

- Permite listar os repositórios de um perfil do GitHub com suas informações
- Interatividade sem a necessidade de atualizar o navegador
- Paginação dos resultados para grandes volumes de dados

---

## Integrações e Processos

- **GitHub API:** o backend se comunica com a API oficial do GitHub que disponibiliza informações sobre perfis e repositórios públicos.
- **Comunicação com API própria:** o frontend se comunica com o backend a partir de requisições da API Fetch do ecossistema JavaScript.
- **Docker:** ambiente de desenvolvimento do backend configurado em Docker e orquestrado com Docker Compose.


---


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


