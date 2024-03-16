# Kohana CRUD

## First run instructions

```bash
docker-compose up -d
```

```bash
docker exec kohana_php php /var/www/html/index.php --task=db:migrate --fresh=true
```

```bash
docker exec kohana_php php /var/www/html/index.php --task=db:seed
```

### DONT USE `--fresh=true` IF YOU DONT WANT TO DROP ALL TABLES