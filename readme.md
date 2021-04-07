# PHotel

Sistema de gestão para hotéis e pousadas.

:construction: Em construção :construction:

**:warning: Este projeto é para estudos apenas, não o use em produção. :warning:**

## Requisitos

Para rodar o projeto, você precisa:

-   [Apache](https://httpd.apache.org/)
-   [PHP](https://www.php.net/)
-   [MySQL](https://www.mysql.com/)

Para contribuir, você precisa dos gerenciadores de pacotes:

-   [Composer](https://getcomposer.org/)
-   [Node/NPM](https://nodejs.org/en/)
-   [Yarn](https://yarnpkg.com/)*

    **Opcional*

## Instalação

Baixe o repositório, ou clone:

```sh
~ git clone https://github.com/wgrfsantos/photel 
```

Em seguida, copie o arquivo `config.sample.php` e cole na mesma pasta com o nome `config.php`.
Abra-o e preencha as configurações correspondentes.

```php
define("BASE_URL", "http://localhost/photel/");
define("BASE_URL_SITE", "http://localhost/photel/");
define("PATH_SITE", "../photel/");
$config['dbname'] = 'hpj';
$config['host'] = 'localhost';
$config['dbuser'] = 'root';
$config['dbpass'] = '';
```

## Contribuindo

Para aqueles que desejem contribuir, lembre-se de instalar todas as dependências:

```sh
~ cd photel
~/photel composer install
~/photel yarn install
```

Antes de subir o seu código, teste-o:

```sh
# Cheque sua sintaxe PHP
~/photel ./ci-phplint

# Cheque se seguiu o padrão PSR12
~/photel composer phpcs

# Análise seus arquivos PHP
~/photel composer psalm

# Cheque seus arquivos CSS
~/photel yarn css-lint

# Cheque seus arquivos JS
~/photel yarn js-lint
```

Tudo estando certo, faça uma pull request.