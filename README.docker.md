# Dockerization for INC Hymns

This project is now ready for Dockerization. Below are the steps to build and run the application using Docker.

## Files Created
- `Dockerfile`: Multi-stage build (Node for assets, PHP 8.2-FPM for the app).
- `docker-compose.yml`: Defines services for `app`, `web` (Nginx), `db` (MySQL), and `redis`.
- `docker/nginx/default.conf`: Nginx configuration tailored for Laravel.
- `.dockerignore`: Optimizes the build by excluding unnecessary files.

## Prerequisites
- Docker and Docker Compose installed on your machine.

## Getting Started

### 1. Configure Environment
Ensure your `.env` file is set up correctly for Docker. Key settings:
```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=inc_hymns
DB_USERNAME=inc_hymns
DB_PASSWORD=masunurin

REDIS_HOST=redis
```

### 2. Build and Start
Run the following command to build the images and start the containers:
```bash
docker compose up -d --build
```

### 3. Application Setup
Once the containers are running, perform the initial setup:

**Install Composer dependencies & Generate Key:**
(The Dockerfile already does this, but if you need to run it manually:)
```bash
docker compose exec app php artisan key:generate
```

**Run Migrations:**
```bash
docker compose exec app php artisan migrate
```

**Import Database (Optional):**
If you want to import your existing SQL dump:
```bash
docker compose exec -T db mysql -uinc_hymns -pmasunurin inc_hymns < "inc_hymns (3).sql"
```

## Accessing the App
The application will be available at:
- **Web App:** [http://localhost:8000](http://localhost:8000)

## Useful Commands
- **Stop Containers:** `docker compose down`
- **View Logs:** `docker compose logs -f`
- **Shell Access (App):** `docker compose exec app sh`
- **Shell Access (DB):** `docker compose exec db sh`
