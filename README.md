1. Склонировать репозиторий laradock
```shell
git submodule init
git submodule update
```
2. Скопировать файлы конфигурации окружиния для laravel и laradock
```shell
cp .env.example .env
cp .env.laradock ./laradock/.env
```

3. Запустить docker compose
```shell
docker-compose -f ./laradock/docker-compose.yml up -d nginx mysql redis memcached clickhouse
```

4. Перейти в командную строку контейнера workspace
```shell
docker-compose -f ./laradock/docker-compose.yml exec --user=laradock workspace bash
```

5. Установить зависимости composer
```shell
composer install
```

6. Установить зависимости npm и скомпилировать скрипты и стили
```shell
npm install
npm run dev // для разработки
npm run prod // для продакшена
```

7. Выполнить миграции бд
```shell
php artisan migrate
```
