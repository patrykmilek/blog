
# Laravel Blog Application

## Prerequisites

Before you begin, ensure you have the following installed on your machine:
- Docker Desktop
- Node.js (optional, if you prefer to run npm commands locally)

## Setup Instructions

Follow these steps to set up and run the project:

### 1. Install Docker Desktop
- Download and install Docker Desktop from the official website: [Download Docker](https://www.docker.com/products/docker-desktop).
- Once installed, ensure Docker is running on your machine.

### 2. Clone the Project
- Clone the GitHub repository to your local machine:
    ```bash
    git clone https://github.com/your-repo-url.git
    cd blog
    ```

### 3. Configure the `.env` File
- Copy `.env.example` to `.env`:
    ```bash
    cp .env.example .env
    ```
- Update the `.env` file to configure the database settings (Docker will handle most of this):
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=rootpassword
    ```

### 4. Start Docker Containers
- Run Docker Compose to start the application containers:
    ```bash
    docker-compose up -d
    ```
- Verify that the containers are running by executing:
    ```bash
    docker ps
    ```

### 5. Enter the Application Container
- Access the running application container:
    ```bash
    docker-compose exec app bash
    ```

### 6. Generate the Application Key
- Inside the container, generate the Laravel application key:
    ```bash
    php artisan key:generate
    ```

### 7. Run Migrations and Seed the Database
- Inside the container, run the migrations and seed the database with sample data:
    ```bash
    php artisan migrate --seed
    ```

### 8. Install npm Dependencies and Run the Front-End Build
- Still inside the container or on your local machine, install the npm dependencies:
    ```bash
    npm install
    ```
- Then, run the front-end build with automatic refreshing:
    ```bash
    npm run dev
    ```

### 9. Access the Application
- Your Laravel application should now be accessible at [http://localhost:8000](http://localhost:8000).

## Conclusion

You have successfully set up and run the Laravel blog application using Docker. If you encounter any issues, please check the Docker and Laravel documentation for further troubleshooting.
