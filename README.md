# FIAP - DESAFIO PHP

## Requisitos:

- MySQL
- PHP >= 7.4
- Composer >= 2

<hr/>

## Instalação:

O processo de instalação é bem simples. Basta clonar o repositório, e instalar as dependências com o somposer.

Clone o repositório:

``` bash 
git clone https://github.com/murilomagalhaes/fiap-desafio-php.git
```

Entre no diretório

``` bash
cd fiap-desafio-php
```

Instale as dependências

```bash
composer install
```

<hr/>

## Configuração:

A configuração do app consiste em copiar o arquivo `.env.example` presente no repositório, e renomear a cópia para
`.env`.
Em seguida, ajuste as variáveis presentes neste arquivo. Essas variáveis são necessárias para a conexão do app com o
banco de dados. Claro, para preencher as variáveis, antes é preciso criar um
banco de dados no seu MySQL Server

Copiando o .env.example

```bash
cp .env.example .env
```

## Populando o Banco de Dados:
Para criar a estrutura das tabelas, e popular o banco com dados iniciais, basta executar o SQL no arquivo `database/dump.sql`

## Executando o app:

Para executar o app, utilizaremos o servidor HTTP nativo do PHP com o comando abaixo. Se necessário, troque a porta 8000
para uma outra de sua preferência.

```bash
php -S localhost:8000 public/index.php
```
Após isso, abra o seu navegador e entre no endereço http://localhost:8000, e você será direcionado para a página de login.

**Credenciais**

- Email: admin@admin.com
- Senha: admin


