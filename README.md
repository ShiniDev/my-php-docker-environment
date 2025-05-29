## Purpose

The purpose of this repository is so that I can continuously improve my local development environment by adapting good practices and using my experience while using this structure.

## Install

**Prerequisites:**

* You need Docker and Docker Compose installed.
* You need to add the following entry to your system's `hosts` file to access the phpMyAdmin page:
    ```
    127.0.0.1 pma.localhost
    ```

**Running the Environment:**

1.  Navigate to the root directory of this project in your terminal.
2.  Run the following command to build and start the services in detached mode:
    ```bash
    docker-compose up -d
    ```