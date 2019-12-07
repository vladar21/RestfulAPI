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

№№№ метод read().

[home page url]/[название сущности]/read.php  
Например: http://localhost:8000/book/read.php

