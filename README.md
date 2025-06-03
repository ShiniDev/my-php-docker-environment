## Purpose

The purpose of this repository is so that I can continuously improve my local development environment by adapting good practices and using my experience while using this structure.

## Install

**Prerequisites:**

* You need Docker and Docker Compose installed.
* You need to add the following entry to your system's `hosts` file to access the phpMyAdmin page:
    ```
    127.0.0.1 pma.localhost
    ```

**Setting up for Laravel:**

1.  **Place your Laravel Application:**
    Copy your existing Laravel application into the `src/` directory located in the root of this project. If you're starting a new project, this `src/` directory will be its home.

2.  **Configure Nginx/Caddy Root for Laravel:**
    * **If using Nginx:** Locate your Nginx configuration file (commonly found at a path like `./config/nginx/default.conf` or similar). Open the file and find the `root` directive. It might initially look like:
        ```nginx
        root /var/www/html;
        ```
        Change this line to point to Laravel's public directory:
        ```nginx
        root /var/www/html/public;
        ```

**Running the Environment:**

1.  Navigate to the root directory of this project in your terminal.
2.  Ensure any necessary environment variables (like `${MYSQL_DATABASE}`, etc., mentioned in `docker-compose.yml`) are set up, create a `.env` file at the root of the project if not already handled.
3.  Run the following command to build (or rebuild if you changed configurations) and start the services in detached mode:
    ```bash
    docker compose up -d --build
    ```

## Using Node.js/npm (Optional)

Your `docker-compose.yml` includes a commented-out service definition for Node.js if you need to use `npm` or other Node.js-based tools for your project (e.g., frontend asset compilation).

**To enable the Node.js service:**

1.  Open your `docker-compose.yml` file.
2.  Find the section for the `node` service (it's currently commented out).
3.  Uncomment the entire `node` service definition:
    ```yaml
    # node:
    #   image: node:24-alpine
    #   entrypoint: [ "tail", "-f", "/dev/null" ]
    #   working_dir: /app
    #   volumes:
    #     - ./src:/app
    ```
    Should become:
    ```yaml
    node:
      image: node:24-alpine
      # This entrypoint keeps the service running, allowing you to use 'docker compose exec'.
      # If you only plan to run one-off 'docker compose run' commands, you might comment this out.
      entrypoint: [ "tail", "-f", "/dev/null" ]
      working_dir: /app
      volumes:
        - ./src:/app # Mounts your project's src directory to /app inside the container
    ```
4.  After uncommenting, restart your Docker Compose environment, making sure to include the new service:
    ```bash
    docker compose up -d --build
    ```

**How to use npm with the Node.js service:**

The `node` service uses the `node:24-alpine` image. Your `./src` directory is mounted as `/app` inside this container, and `/app` is set as the working directory. This means `npm` commands will operate on the files within your `./src` directory.

* **If the `entrypoint: [ "tail", "-f", "/dev/null" ]` is active (service running continuously):**
    You can execute `npm` commands (or open a shell) inside the running `node` container:
    ```bash
    # Run an npm install
    docker compose exec node npm install

    # Run another npm command (e.g., build)
    docker compose exec node npm run build

    # Get a shell inside the node container
    docker compose exec node sh
    ```

* **For one-off npm commands (if you prefer not to keep the `node` container always running via the `tail` entrypoint):**
    You could comment out the `entrypoint` line in `docker-compose.yml`. In this case, you would typically use `docker compose run`:
    ```bash
    # Run an npm install (this starts a new container for the command, then stops it)
    docker compose run --rm node npm install

    # Run another npm command
    docker compose run --rm node npm run build
    ```