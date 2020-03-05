# Desafío
El procedimiento para implementarlo sería el siguiente:

_1ro clonar el repositorio (se asume que está instalado git)_
```
https://github.com/keyoj/desafio.git
```

_2do ejecutar "composer install" dentro de la carpeta del proyecto (se asume que esta instalado composer)_

_3ro renombrar archivo .env.example a .env y completar datos de bd y mailtrap
4to ejecutar_
```
php artisan key:generate
```
_5to ejecutar " para borrar el contenido de la bd asociada y cargar datos de ejemplo_
```
php artisan migrate:fresh --seed
```
_6to ejecutar servidor para levantar servidor y..._
```
php artisan serve --port 8080

_7mo en otra terminal ejecutar para correr worker de jobs_
```
php artisan queue:work
```
_8mo hacer pruebas de la api en un navegador o en postman_

* [http://localhost:8080/api/clients](http://localhost:8080/api/clients)
* [http://localhost:8080/api/payments?client=1](http://localhost:8080/api/payments?client=1)   -los ids disponibles son del 1 al 50
...
*[http://localhost:8080/api/payments?client=50](http://localhost:8080/api/payments?client=50)
POST para:
* [http://localhost:8080/api/payments](http://localhost:8080/api/payments) -los datos mínimos son user_id (id de cliente existente), expires_at (formato YYYY-MM-DD), amount, payment_date (formato YYYY-MM-DD)
