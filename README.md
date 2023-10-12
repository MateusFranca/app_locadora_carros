# Model (Modelo):

Representa a camada de acesso aos dados na aplicação. Ele interage com o banco de dados, define relações entre tabelas e contém lógica de negócios.

# Migration (Migração):

É um arquivo que descreve as alterações na estrutura do banco de dados. Facilita o controle de versão do banco de dados e permite que equipes trabalhem em conjunto.

# Controller (Controlador):

Controladores processam as requisições HTTP e orquestram a lógica de negócios da aplicação. Eles interagem com os modelos e retornam respostas para as rotas.

# Route (Rota):

Define como as requisições HTTP são manipuladas na aplicação. Pode ser uma URL específica que corresponde a um controlador e método.

# ENV:

Arquivo de configuração que armazena variáveis de ambiente, como credenciais de banco de dados e configurações específicas do ambiente.

# Eloquent ORM:

O Laravel inclui um poderoso ORM (Object-Relational Mapping) chamado Eloquent, que facilita a interação com bancos de dados relacionais.
 
## Comando para criar o Model:

php artisan make:model nomeModel

## Comando para criar a Migration

php artisan make:migration create_nome_mifration

## Comando para criar o Model e a Migration: 

php artisan make:model -m

## Comando para criar o Model, Migration, Controller: 

php artisan make:model --migration --controller --resource nomeArquivo

- Esse "--resource" cria os métodos padrões para usarmos.

- Forma abreviada do comandp: php artisan make:model -mcr nomeArquivo

- Outra forma: php artisanmake:model --all Carro. Esse comando cria: Model, Factory, Migration, Seeder, Controller... 

- Forma abreviada da anterior: php artisan make:model -a Cliente

# Entendendo o conceito de endpoint (URL, URN, URI):

- URL: Link do site.
- URN: Caminhi para as páginas dentro da aplicação.
- URI: Combinação de URL + URN, um identificador único.

# GET E POST

- O método GET é seguro e idempotente (mostra sempre o mesmo resultado). Não é bom para fazer modificações.

- O método POST é apropriado para a submissão de dados que podem modificar o estado do sevirdo. É omumente usado para ações como criar, atualizar ou excluir recursos.