

## Requirements Check
- Homepage Form, Table, Chart, Form Validation -> Done
- Send Email by queue job -> Done 
- Docker -> Done
- use Dependency Injection -> Done
- Have 100% testing coverage. Backend and Frontend -> Done
- I used also Adapter Design Pattern to handle apis
- I faked Rapid api at another adapter to make development faster

## Installation
- clone repo
- cd docker
- docker-compose build && docker-compose up -d
- add mailtrap credentials at .env
- open phpmyadmin http://localhost:8080/ and create db xm_mets_task
- docker exec -it mets-xm-task-apache composer install
- docker exec -it mets-xm-task-apache php artisan migrate
- docker exec -it mets-xm-task-apache php artisan db:seed
- site link -> http://localhost:8088/ 
- //to run test-cases
- docker exec -it mets-xm-task-apache php artisan test
- //to run queue:jobs, if you want to change queue from sync to database
- docker exec -it mets-xm-task-apache php artisan queue:listen

