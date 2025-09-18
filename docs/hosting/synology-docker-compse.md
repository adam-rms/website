---
sidebar_position: 5
title: Synology NAS Docker Compose
---

This is a customized version of the [advanced Docker Compose configuration](./advanced-docker-compose) for running AdamRMS with a MySQL database inside of a Synology NAS. This configuration is suitable for production use, and includes additional services such as a MinIO Server for S3 Storage and mysql backups.

Upload the `docker-compose.yml` file in the same directory as the `.env` on your Synology.

Edit the `docker-compose.yml` and update:
- MINIO_DOMAIN
- MINIO_ROOT_PASSWORD

```yaml
services:
  adam_db:
    image: index.docker.io/mysql/mysql-server:8.0
    command: --default-authentication-plugin=mysql_native_password --innodb-thread-concurrency=0 --sort_buffer_size=512K
    container_name: adam_db
#    ports: # Disable this if you would like to keep the database on the local machine only (recommended)
#      - 3306:3306
    volumes:
      - db_data_1:/var/lib/mysql
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
      adam_db:
        condition: service_healthy
    environment:
      - DB_HOSTNAME=adam_db
      - DB_DATABASE=adamrms
      - DB_USERNAME=userDocker
      - DB_PASSWORD=passDocker
      - DB_PORT=3306
    user: root
    ports:
    - "8089:80"
  mysql-backup:
    image: index.docker.io/databack/mysql-backup:1.0.0-rc5
    restart: unless-stopped
    container_name: mysql-backup
    command: dump
    environment:
      - DB_SERVER=adam_db
      - DB_PORT=3306
      - DB_USER=userDocker
      - DB_PASS=passDocker
      - DB_NAMES=adamrms
      - NO_DATABASE_NAME=true
      - DB_DUMP_FREQUENCY=60 #Hourly
      - DB_DUMP_BEGIN=+2
      - COMPRESSION=gzip
      - DB_DUMP_SAFECHARS=true
      - NICE=true
    env_file:
      - .env
    depends_on:
      adam_db:
        condition: service_healthy
    volumes:
      - /etc/localtime:/etc/localtime:ro
  watchtower:
    image: index.docker.io/containrrr/watchtower:1.7.1
    container_name: watchtower
    restart: always
    environment:
      - WATCHTOWER_CLEANUP=true
      - WATCHTOWER_POLL_INTERVAL=60
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock
  minio:
    image: quay.io/minio/minio:latest
    container_name: minio
    restart: always
    command: server /data --console-address ":9001"
    environment:
      MINIO_ROOT_USER: minioadmin       # Access Key
      MINIO_ROOT_PASSWORD: CHANGE_THIS_MINO_PW  # Secret Key (mind. 8 Zeichen)
      MINIO_REGION_NAME: us-east-1
      MINIO_API_CORS_ALLOW_ORIGIN: '*'
      MINIO_DOMAIN: https://yourPublicMinio.url
    ports:
      - "9000:9000"   # S3 API Endpoint
      - "9001:9001"   # Web Console
    volumes:
      - minio_data:/data
volumes:
  db_data_1: {}
  minio_data: {}
```

## Environment Variables

Place the following environment variables in a `.env` file in the same directory as the `docker-compose.yml` file.

```bash
# For the remote mysql access, set a root password
MYSQL_ROOT_PASSWORD=

```

## Create the Project

Go to your Synology Nas -> Container Manager -> Projects -> Create.

Give it a Name and selec the Folder where you stored your `docker-compose.yml`, then select use existing.


## Create Bucket in MinIO

Go to [http://yourNasIp:9000](http://yourNasIp:9000) and login with the Username `minioadmin` and your given Password (CHANGE_THIS_MINO_PW).

Create a new Container `adam`


## Connect MinIO with AdamRMS

Now login into your Adam-RMS and update the S3 Storage Options:

```yaml
File storage enabled: enabled
AWS Server Key: minioadmin
AWS Server Secret Key: CHANGE_THIS_MINO_PW
AWS S3 Bucket Name: adam
AWS S3 Bucket Browser Endpoint: http://yourNasIp:9000
AWS S3 Bucket Server Endpoint: http://yourNasIp:9000
Should path-style requests be sent to the upload endpoint: Enabled
AWS S3 Bucket Region: us-east-1
```


## External Service

Now everything should be ready to upload your Files.
