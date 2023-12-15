# Log processor app
App that receives HTTP requests log file and transforms it into JSON format, to be able to analyze its data.

## Architecture
The app has been divided into a backend REST API and a frontend javascript client.

### Backend
The backend has been implemented using PHP-FPM 8.2 with Symfony 6.4 and following TDD, the principles of hexagonal and DDD architecture, separating the application into Domain, Application and Infrastructure layers and using ports and adapters for communication between them.
PHPUnit is used for unit and integration tests.

### Frontend
The frontend has been implemented with Nextjs and Chartjs library for the charts.
There is a page to upload the file, and another page to visualize the charts, which makes a request to the backend to get the json.
Each chart has its own component.

### Deployment
Both backend and frontend apps are deployed into Google Cloud Run via Github Actions pipelines.

## Installation
### Requirements
Docker and docker-compose are required to launch the app in a local environment.
### Instructions

    docker compose up --build
Access to http://localhost:3080 to load the frontend app.
### Running tests

    docker compose exec backend php bin/phpunit
## Future improvements

- UI/UX enhancements in the frontend
- Hexagonal Architecture in the frontend
- Frontend testing
- Improving backend exceptions log
- Improving backend exceptions management
- CI/CD improved to launch the tests
- PHPStan integration in the backend
- Linting
