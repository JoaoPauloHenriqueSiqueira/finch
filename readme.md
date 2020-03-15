# Finch - Workflow

Projeto para teste dev - PHP

## Requisitos

O projeto foi aplicado em um sistema Linux - Ubuntu (19.10)

```bash
- docker
- git
```
## Criação das pastas

Descompactar conteúdo docker (anexado no email) em uma pasta no sistema.

Na pasta em que descompactamos os arquivos docker, iremos clonar o projeto:

```json
git clone https://github.com/JoaoPauloHenriqueSiqueira/finch.git finch
```

## Containers
Há 3 containers: PHP, Mysql e Phpmyadmin, subi-los através do comando

```json
sudo docker-compose up -d
```

## Database

Neste momento, já devemos ser capazes de acessar o phpmyadmin através da url: http://localhost:3380/index.php e criar o banch finch

## Configs .env
Copiar o .env.example 

```json
cp .env.example .env
```

Alterar conteúdo novo arquivo:

```json
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=finch
DB_USERNAME=root
DB_PASSWORD=root   
``` 

## Configurar aplicação

Acessar o terminal  do container php:

```json
sudo docker exec -it 9008019917e3 bash 
```

*9008019917e3* é o ID do meu container, é possível listar os containers através do comando

```json
 sudo docker ps
```

E instalar dependências

```json
composer install

```

Iremos também dar permissão para o diretório de logs:


```json
chmod -R 777 storage/
``` 


E finalmente criar key para aplicação:

```json
php artisan key:generate

```


## Popular DB e c

Ainda dentro do container PHP, iremos executar os comandos:

Criar tabelas:
```json
php artisan migrate

```

Popular tabelas:

```json
php artisan db:seed
```

## Acessando sistema

O endereço para acessar é http://localhost/finch/public/login e os usuários gerados no seed, são:

```json
Usuário: joao@gmail.com
Senha: joao123456
```

```json
Usuário: leonardo@gmail.com
Senha: leonardo123456
```