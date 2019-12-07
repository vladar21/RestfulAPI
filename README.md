# RestfulAPI
## Структура файлов проекта

* dir: RestfulAPI
    * dir: author (CRUD для сущности Автор)
        - file: create.php
        - file: delete.php
        - file: read_one.php
        - file: read.php
        - file: search.php
        - file: update.php
    * dir: authors (CRUD для сущности Авторы, через которую реализована связь многие ко многим между сущностями Автор и Книга)
        - file: create.php
        - file: delete.php
        - file: read_one.php
        - file: read.php
        - file: search.php
        - file: update.php
    * dir: book (CRUD для сущности Книга)
        - file: create.php
        - file: delete.php
        - file: read_one.php
        - file: read_paging.php
        - file: read.php
        - file: search.php
        - file: update.php
    * config
        - file: core.php (вспомогательные функции и переменные для пагинации)
        - file: database.php (настройки для связи с базой данных)
        - file: Library.vpd.jpg (ERP diagramm)
        - file: libraryinstall.sql (файл с дампом базы, развернуть с помощью командной строки MySQL и оператора source)
     * dir: objects (Классы сущностей проекта)
        - file: author.php
        - file: authors.php
        - file: book.php
        - file: publisher.php
     * dir: publisher (CRUD для сущности Издатель)
        - file: create.php
        - file: delete.php
        - file: read_one.php
        - file: read.php
        - file: search.php
        - file: update.php
     * dir: shared (пагинация)
        - file: utilities.php

## Развертываене базы данных

Файл с дампом базы libraryinstall.sql находится в каталоге config, его можно легко развернуть с помощью командной строки MySQL и оператора source.

## Примеры запросов к API

Работа API тестировалась с помощью программы Postman (https://www.getpostman.com/).  

### Метод read().

Считываем всю информацию из таблицы сущности.  

Структура запроса:  [home page url]/[название сущности]/read.php  
Пример: http://localhost:8000/book/read.php

### Метод readOne().

Считываем конкретную строку из таблицы сущности.  

Структура запроса:  [home page url]/[название сущности]/read_one.php?[id строки сущности]=[номер id]  
Пример: http://localhost:8000/book/read_one.php?idbook=7

### Метод readPaging().

Метод read(), но с пагинацией. Работатет только для сущности Книга (Book).

Структура запроса:  [home page url]/book/read_paging.php  
Пример: http://localhost:8000/book/read_paging.php

### Метод create().

Создает новый объект сущности.

Структура запроса:  
GET запрос [home page url]/[название сущности]/create.php  
POST(JSON) запрос { "idpublisher" : "[id издателя]", "title" : "[название книги]"}  
Пример:  
GET http://localhost:8000/book/create.php  
POST { "idpublisher" : "3", "title" : "New Book Created" }

###

###
