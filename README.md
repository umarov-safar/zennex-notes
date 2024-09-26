# Установка и запуска

1. Клонирование проекта
```shell
git clone https://github.com/umarov-safar/zennex-notes.git
```
Затем перейдите в директорию проекта:
```shell
cd zennex-notes
```

2. Настройка переменных окружения
```shell
cp .env.example .env
```

3. Запуск docker-compose
```shell
docker-compose up -d
```

4. npm
```shell
docker-compose exec app npm install

docker-compose exec app npm run build
```

### API url
[http:://localhost:8000/api-docs/swagger](http:://localhost:8000/api-docs/swagger)


