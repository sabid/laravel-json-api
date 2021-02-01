<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Laravel 8 API REST

### Requerimientos

* Laravel 8 
* PHP 7.4
* MySQL 5.7
* [Requerimientos adicionales](https://laravel.com/docs/8.x/deployment#server-requirements)

## Instalación en Local

### 1. Clonar el proyecto

Puede clonar el proyecto desde el repositorio de github.com

```bash
git clone git@github.com:sabid/laravel-json-api.git
```

### 2. Archivo en Entorno

El proyecto tiene un archivo `.env.example` en el directorio raíz. Debe cambiar el nombre de este archivo a `.env`

```bash
cp .env.example .env
```

Nota: Los archivos que inician con `.` son archivos ocultos, asegúrese de tener los archivos ocultos visibles en su sistema.

### 3. Composer
Las dependencias del proyecto Laravel se gestionan a través de la herramienta `PHP Composer`. El primer paso es instalar las dependencias ingresando a su proyecto con la terminal y escribiendo este comando:

```bash
composer install
```

### 5. Crear y Configurar la Base de Datos

Debe crear la base de datos en su entorno de trabajo local

* MySQL 5.7
* Encoding: utf8mb4
* Collation: utf8mb4_unicode_ci

Y en su archivo `.env` actualice las siguientes líneas:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_api_rest
DB_USERNAME=root
DB_PASSWORD=password
```

### 6. Comandos Artisan 

Lo primero que vamos a hacer es configurar la clave que utilizará Laravel al realizar el cifrado.

```bash 
php artisan key:generate
```

Debería ver un mensaje verde que indica que su clave se generó correctamente. Además, debería ver reflejada la variable `APP_KEY` en su archivo `.env`.

Es hora de ver si las credenciales de su base de datos son correctas.

Vamos a ejecutar las migraciones integradas para crear las tablas de la base de datos:

```bash 
php artisan migrate
```

Debería ver un mensaje para cada tabla migrada, si no lo hace y ve errores, lo más probable es que sus credenciales no sean correctas.

Ahora vamos a ejecutar los `Seeder` para llenar la base de datos con Usuarios` y `Productos` de muestra:

```bash 
php artisan db:seed
```

Para que la autentificación funcione y pueda emitir tokens, debemos crear las llaves del paquete Laravel Passport.

```bash 
php artisan passport:install
```

---

## Probar la API REST en Postman

Ahora ya tiene el proyecto configurado y listo para realizar pruebas en Postman.

El proyecto en Postman, tiene configurado dos entornos

### Local Development

* `api_url` = `https://laravel-api.test` (Aquí debe colocar la url del proyecto laravel, en su entorno de trabajo local)

* `token` = El token se obtendrá automáticamente, cada vez que inicie sesión y se utilizará en todas las peticiones del CRUD de Usuarios y el CRUD de productos 

![Entorno Producción](https://laravel-api-rest.negociosonline.net/doc/entorno-local.png)

### Producción 

Se configuró el dominio: [https://laravel-api-rest.negociosonline.net](https://laravel-api-rest.negociosonline.net), para hacer las pruebas de la API REST en producción.

* `api_url` = `https://laravel-api-rest.negociosonline.net`

* `token` = El token se obtendrá automáticamente, cada vez que inicie sesión y se utilizará en todas las peticiones del CRUD de usuario y el CRUD de productos

![Entorno Producción](https://laravel-api-rest.negociosonline.net/doc/entorno-produccion.png)
 
[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/bcc348bf07dd9268ebcf#?env%5BProduction%20%5D=W3sia2V5IjoiYXBpX3VybCIsInZhbHVlIjoiaHR0cHM6Ly9sYXJhdmVsLWFwaS1yZXN0Lm5lZ29jaW9zb25saW5lLm5ldCIsImVuYWJsZWQiOnRydWV9LHsia2V5IjoidG9rZW4iLCJ2YWx1ZSI6IiIsImVuYWJsZWQiOnRydWV9XQ==)

