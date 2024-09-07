---
sidebar_position: 3
title: Simple Docker Compose
---

Place the following `docker-compose.yml` file in the same directory as the `.env` file below, and then run `docker compose up -d` to start the services.

```yaml
services:
  db:
    image: index.docker.io/mysql/mysql-server:8.0
    command: --default-authentication-plugin=mysql_native_password --innodb-thread-concurrency=0 --sort_buffer_size=512K
    container_name: db
    ports: # Remove this if you would like to keep the database on the local machine only (recommended)
      - 3306:3306
    volumes:
      - db_data:/var/lib/mysql
      - /etc/localtime:/etc/localtime:ro
    restart: always
    environment:
      - MYSQL_DATABASE=adamrms
      - MYSQL_ROOT_HOST=%
      - MYSQL_USER=userDocker
      - MYSQL_PASSWORD=passDocker
    env_file:
      - .env
    healthcheck:
      test:
        [
          "CMD",
          "mysqladmin",
          "ping",
          "-h",
          "localhost",
          "-u",
          "root",
          "-p$$MYSQL_ROOT_PASSWORD",
        ]
      timeout: 20s
      retries: 10
  adamrms:
    image: ghcr.io/adam-rms/adam-rms:latest
    container_name: adamrms
    restart: always
    depends_on:
      db:
        condition: service_healthy
    environment:
      - DB_HOSTNAME=db
      - DB_DATABASE=adamrms
      - DB_USERNAME=userDocker
      - DB_PASSWORD=passDocker
      - DB_PORT=3306
volumes:
  db_data: {}
```

## Environment Variables

Place the following environment variables in a `.env` file in the same directory as the `docker-compose.yml` file.

```bash
# For the remote mysql access, set a root password
MYSQL_ROOT_PASSWORD=YOURTOPSECRETPASSWORD
```
