---
sidebar_position: 6
---

# Local Development

The repository includes an optional Compose environment for the example application, Redis, and either PostgreSQL or MariaDB.

## Prepare the environment

```bash
cp .env.example .env
```

Replace the example passwords before sharing the environment outside your local machine.

## Start PostgreSQL

```bash
docker compose -f compose.dev.yml --profile postgres up
```

Open the example application at `http://localhost:8080`. DbGate is available at `http://localhost:18080`.

## Start MariaDB

```bash
docker compose -f compose.dev.yml --profile mariadb up
```

The Compose environment always starts the PHP development server and Redis. The selected profile adds the corresponding relational database and DbGate.

## Start both databases

```bash
docker compose -f compose.dev.yml --profile postgres --profile mariadb up
```

## Stop and remove data

```bash
docker compose -f compose.dev.yml down -v
```

`-v` removes the named Redis, database, DbGate, and template cache volumes.