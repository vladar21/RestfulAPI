# RestfulAPI
## Структура файлов проекта

1. dir: RestfulAPI
    1. dir: author (CRUD для сущности Автор)
        1.1.1. file: create.php
    1.1.2. file: delete.php
    1.1.3. file: read_one.php
    1.1.4. file: read.php
    1.1.5. file: search.php
    1.1.6. file: update.php
  1.2. dir: authors (CRUD для сущности Авторы, через которую реализована связь многие ко многим между сущностями Автор и Книга)
    1.2.1. file: create.php
    1.2.2. file: delete.php
    1.2.3. file: read_one.php
    1.2.4. file: read.php
    1.2.5. file: search.php
    1.2.6. file: update.php
  1.3. dir: book (CRUD для сущности Книга)
1.3.1. file: create.php
1.3.2. file: delete.php
1.3.3. file: read_one.php
1.3.4. file: read_paging.php
1.3.5. file: read.php
1.3.6. file: search.php
1.3.7. file: update.php
1.4. config
1.4.1. file: core.php (вспомогательные функции и переменные для пагинации)
1.4.2. file: database.php (настройки для связи с базой данных)
1.4.3. file: Library.vpd.jpg (ERP diagramm)
1.4.4. file: libraryinstall.sql (файл с дампом базы, развернуть с помощью командной строки MySQL и оператора source)
1.5. dir: objects (Классы сущностей проекта)
1.5.1. file: author.php
1.5.2. file: authors.php
1.5.3. file: book.php
1.5.6. file: publisher.php
1.6. dir: publisher (CRUD для сущности Издатель)
1.6.1. file: create.php
1.6.2. file: delete.php
1.6.3. file: read_one.php
1.6.4. file: read.php
1.6.5. file: search.php
1.6.6. file: update.php
1.7. dir: shared (пагинация)

## Развертываене базы данных

Файл с дампом базы libraryinstall.sql находится в каталоге config, развернуть с помощью командной строки MySQL и оператора source.

## Примеры запросов к API
