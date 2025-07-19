FROM debian:bullseye-slim

RUN apt-get update && apt-get install -y \
    postgresql \
    postgresql-contrib \
    php-cli \
    php-pgsql \
    curl \
    && rm -rf /var/lib/apt/lists/*

COPY init.sql /docker-entrypoint-initdb.d/init.sql

COPY . /app

WORKDIR /app

CMD service postgresql start && \
    su - postgres -c "createdb sebo" && \
    su - postgres -c "psql -d sebo -f /docker-entrypoint-initdb.d/init.sql" && \
    su - postgres -c "psql -c \"CREATE USER usuario WITH PASSWORD '12345678'; GRANT ALL PRIVILEGES ON DATABASE sebo TO usuario;\"" && \
    su - postgres -c "psql -d sebo -c \"GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO usuario; GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO usuario; ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT ALL ON TABLES TO usuario; ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT ALL ON SEQUENCES TO usuario;\"" && \
    php -d upload_max_filesize=50M -d post_max_size=50M -S 0.0.0.0:80 -t /app

