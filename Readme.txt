1) Откройте application/config/config.php файл в текстовом редакторе и установите основной (base) URL
2) Создайте БД и откройте application/config/database.php файл и установите настройки вашей базы данных
3) Откройте application/config/migration.php файл в текстовом редакторе и установите $config['migration_enabled'] = TRUE,
4) Запустите миграции перейдя по ссылке http://имя_сайта/migrate (данное действие создаст в
    базеданных все необходимые таблицы, проверьте, что таблицы были созданы)
5) В файле config/migration.php установите обратно $config['migration_enabled'] = FALSE