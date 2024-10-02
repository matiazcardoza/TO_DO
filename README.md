# Proyecto Laravel

Este es un proyecto desarrollado con Laravel, Breeze y Blade. Este archivo contiene instrucciones sobre cómo instalar y ejecutar el proyecto de manera correcta en tu entorno local utilizando XAMPP y MySQL.

## Requisitos Previos

Asegúrate de tener instalado lo siguiente en tu máquina:

- [PHP](https://www.php.net/downloads) (versión 8.0 o superior)
- [Composer](https://getcomposer.org/download/)
- [XAMPP](https://www.apachefriends.org/index.html) (incluye Apache y MySQL)
- [Node.js](https://nodejs.org/en/download/) (opcional, para la gestión de paquetes frontend)

## Instalación

Sigue estos pasos para configurar y ejecutar el proyecto:

1. **Clona el repositorio**

   Abre una terminal y ejecuta el siguiente comando para clonar el repositorio en la carpeta, C:\xampp\htdocs:

   ```bash
   git clone https://github.com/matiazcardoza/TO_DO.git

2. **tambien puedes descargar el archivo .zip**
    y descomprimirlo en la carpeta, C:\xampp\htdocs

3. **desde la terminal navega al directorio del proyecto**
    ```powershell
   cd TO_DO

4. **Instala las dependencias de PHP Ejecuta el siguiente comando para instalar las dependencias de PHP:**
    ```powershell
   composer install

5. **Configura el archivo .env Copia el archivo .env.example y renómbralo a .env:**
Luego, abre el archivo .env y configura los detalles de tu base de datos. Asegúrate de que DB_DATABASE, DB_USERNAME y DB_PASSWORD estén configurados correctamente:
    ```powershell
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=to_do
    DB_USERNAME=root
    DB_PASSWORD=

6. **Crea la base de datos:**
Abre XAMPP y asegúrate de que el servidor Apache y MySQL estén en ejecución.
Accede a phpMyAdmin.
importa la base de datos que esta en la carpeta del proyecto de nombre to_do.sql.
7. **Ejecuta las migraciones Para crear las tablas en la base de datos, ejecuta el siguiente comando:**
    ```powershell
   php artisan key:generate

8. **Ejecuta las migraciones Para crear las tablas en la base de datos, ejecuta el siguiente comando:**
    ```powershell
   php artisan migrate

9. **Instala las dependencias de Node.js (opcional) Si tu proyecto utiliza JavaScript para el frontend, instala las dependencias de Node.js:**
    ```powershell
   npm install

10. **Compila los assets (opcional) Si utilizaste Laravel Mix para gestionar los assets, ejecuta el siguiente comando para compilar los archivos CSS y JavaScript:**
    ```powershellnpm run dev
9. **Compila los assets (opcional) Si utilizaste Laravel Mix para gestionar los assets, ejecuta el siguiente comando para compilar los archivos CSS y JavaScript:**
    ```powershell
   php artisan serve

Ahora puedes acceder a tu aplicación en tu navegador web en la siguiente URL:

   http://localhost:8000


puedes registrar un nuevo usuario o puedes ingresar con el usuario que ya esta registrado:
mail:
user@gmail.com
password:
12345678
