# Fileshare 

## Env requirements

linux, node, php >= 7.0, npm, composer,  mysql/mariadb

## Install the Application
+ Install php dependencies
```bash
composer install
```
+ Up migrations
```bash
php phinx migrate
```
+ Run seeds
```bash
php phinx seed:run
```
+ go to public folder
```bash
cd ./public
```
+ Install frontend dependencies
```bash
npm i
```
+ Run webpack build
```bash
  npm webpack.js
```


## Run tests

### Unit

$ php codecept run unit

### Functional

$ php codecept run functional

### Front end tests

go to yourhost/tests

