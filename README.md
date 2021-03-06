# API REST Artesana

Empezamos por un `switch` y acabamos generando un pequeño framework reutilizable.

Este es el código del curso **Crea una API REST artesana con PHP** https://premium.danielprimo.io/cursos/crea-una-api-rest-artesana-con-php

## Tecnología

Tecnología para resolverlo:
- PHP
- Composer
- Postman
- Mucho cariño y algo de tiempo

## Características

Inicialmente la API REST debe cumplir estos requisitos:

- Gestionar gastos (*expenses*)
- CRUD sobre los gastos: Create, Read, Update, Delete
- Gestionar las peticiones del cliente con GET, POST, PUT y DELETE y dar la respuesta
- Se utiliza JSON para el formato de la API REST
- No necesitamos persistencia. No necesitamos autenticación.

## Instalación en local

1. Descarga el repositorio
2. Copia `.env.example` en `.env`y modifica el parámetro de la URL del calendario de Google ([Cómo se hace](https://support.google.com/calendar/answer/37648?hl=es#zippy=%2Cver-tu-calendario-solo-lectura))
3. Ejecuta `composer dump-autoload -o` para cargar 
4. Ejecuta `php -S localhost:8080 -t api/index.php` para lanzar el servidor local
5. Opciona: Lanza `vercel` para comenzar el despliegue en la nube

## Aviso a navegantes

El código está basado fuertemente en https://gist.github.com/seebz/c00a38d9520e035a6a8c
