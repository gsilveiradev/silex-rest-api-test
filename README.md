# Simple api REST made with Silex
> **Reference:** http://silex.sensiolabs.org/

### Start

- Clone the project
- Run composer install
- Start application: ```php -S 0.0.0.0:8080 -t web web/index.php```
- Access URLs on browser
 - GET http://0.0.0.0:8080/api/mensagens/
 - POST http://0.0.0.0:8080/api/mensagens/ - param: text='TEXT TO INSERT'
 - GET http://0.0.0.0:8080/api/mensagens/{id}