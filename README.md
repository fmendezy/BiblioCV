# BiblioCV - Sistema de Gestión de Currículums para Bibliotecas Municipales

[![Licencia](https://img.shields.io/badge/Licencia-MIT-yellow.svg)](https://opensource.org/licenses/MIT) 
## Descripción
BiblioCV es una plataforma web diseñada para facilitar la creación, gestión y revisión de currículums por parte de personas que frecuentan las bibliotecas municipales, especialmente dirigida a adultos mayores y personas con dificultades digitales. El sistema busca agilizar el proceso de creación de CVs, mejorar la colaboración entre las bibliotecas y ofrecer un acceso unificado a las oportunidades laborales.

Este proyecto está basado en Laravel 11 y MySQL, y tiene como objetivo principal mejorar el proceso manual actual que se lleva a cabo en las bibliotecas municipales de Chile.

## Características

*   **Interfaz sencilla e intuitiva:** Facilita la creación de currículums para usuarios no familiarizados con las herramientas digitales.
*   **Base de datos centralizada:** Permite gestionar y revisar currículums de manera colaborativa entre distintas sucursales de Biblioredes.
*   **Herramientas de asistencia virtual:** Guían al usuario durante el proceso de creación del CV.
*   **Revisión de CVs:** Los funcionarios de las bibliotecas pueden revisar los CVs y colaborar en línea.
*   **Conexión mediante RUT:** Permite la revisión de currículums por parte de los usuarios de las bibliotecas.

## Tecnologías

Este proyecto está desarrollado utilizando las siguientes tecnologías:

*   PHP 8.4.2
*   Laravel 11
*   Breeze 2.3
*   MySQL 8
*   Composer 2.8.4
*   Apache

## Instalación

### Prerrequisitos

*   Tener instalado PHP en la versión 8.4.2 o superior.
*   Tener instalado Composer en la versión 2.8.4 o superior.
*   Tener un servidor de base de datos MySQL 8 o superior.
*   Apache o un servidor web compatible.

### Pasos de instalación

1.  **Clonar el repositorio:**

### Instalación en Windows y Linux

#### Windows

1. **Instalar Chocolatey:**

Si no tienes Chocolatey instalado, puedes instalarlo siguiendo las instrucciones en [https://chocolatey.org/install](https://chocolatey.org/install).

2. **Instalar PHP y Composer:**

Ejecuta los siguientes comandos en PowerShell (como administrador):

```bash
choco install php
choco install composer
```

3. **Clonar el repositorio:**

```bash
git clone https://github.com/fmendezy/bibliocv.git
cd bibliocv
```

4. **Instalar dependencias:**

Ejecuta el siguiente comando para instalar las dependencias de Laravel:

```bash
composer install
```

5. **Configurar el archivo `.env`:**

Abre el archivo `.env` y configura los parámetros de la base de datos:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bibliocv
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

6. **Generar la clave de la aplicación:**

Ejecuta el siguiente comando:

```bash
php artisan key:generate
```

7. **Migraciones y datos de ejemplo:**

Ejecuta las migraciones y los seeders para crear las tablas y cargar datos de ejemplo:

```bash
php artisan migrate:fresh --seed
```

Este comando:
- Creará todas las tablas necesarias
- Cargará bibliotecas de ejemplo
- Creará usuarios con diferentes roles (admin, employee, user)
- Cargará 10 currículums de ejemplo completos con:
  - Datos personales
  - Educación académica
  - Experiencia laboral
  - Habilidades
  - Referencias profesionales

8. **Servir la aplicación:**

Inicia el servidor de desarrollo de Laravel:

```bash
php artisan serve
```

Ahora puedes acceder a la aplicación en tu navegador en `http://localhost:8000`.

#### Linux

1. **Instalar PHP y Composer:**

Ejecuta los siguientes comandos en la terminal:

```bash
sudo apt update
sudo apt install php php-cli php-mbstring unzip curl
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

2. **Clonar el repositorio:**

```bash
git clone https://github.com/fmendezy/bibliocv.git
cd bibliocv
```

3. **Instalar dependencias:**

Ejecuta el siguiente comando para instalar las dependencias de Laravel:

```bash
composer install
```

4. **Configurar el archivo `.env`:**

Abre el archivo `.env` y configura los parámetros de la base de datos:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bibliocv
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

5. **Generar la clave de la aplicación:**

Ejecuta el siguiente comando:

```bash
php artisan key:generate
```

6. **Migraciones de la base de datos:**

Ejecuta las migraciones para crear las tablas:

```bash
php artisan migrate:fresh --seed
```

7. **Servir la aplicación:**

Inicia el servidor de desarrollo de Laravel:

```bash
php artisan serve
```

Ahora puedes acceder a la aplicación en tu navegador en `http://localhost:8000`.

     ### Datos de acceso precargado en DB de usuarios diferenciados:
### Datos de acceso precargado en DB de usuarios diferenciados:

Las siguientes cuentas vienen precargadas en la plataforma para realizar pruebas:

**Administrador:**
- Correo: `administrador@bibliocv.cl`
- Contraseña: `password`
- Rol: Administrador del sistema
- Permisos: Gestión completa de bibliotecas, usuarios y currículums

**Funcionario:**
- Correo: `funcionario@bibliocv.cl`
- Contraseña: `password`
- Rol: Empleado de biblioteca
- Permisos: Gestión de currículums y usuarios de su biblioteca

**Usuario:**
- Correo: `usuario@bibliocv.cl`
- Contraseña: `password`
- Rol: Usuario regular
- Permisos: Gestión de sus propios currículums

Adicionalmente, en la tabla de "users" se encuentran varios funcionarios de las bibliotecas de ejemplo, los cuales pueden ser accedidos utilizando el correo electronico disponible en la base de datos y la contraseña "password".

Cada rol tiene acceso a diferentes funcionalidades:
- **Administrador**: Acceso total al sistema, gestión de bibliotecas y usuarios
- **Funcionario**: Gestión de currículums en su biblioteca asignada
- **Usuario**: Creación y gestión de sus propios currículums

## Contribuciones

Si deseas contribuir al desarrollo de este proyecto, sigue estos pasos:

1.  Haz un *fork* del repositorio.
2.  Crea una nueva *rama* (`git checkout -b feature/nueva-funcionalidad`).
3.  Realiza tus cambios y haz *commit* (`git commit -am 'Agrega nueva funcionalidad'`).
4.  Sube tus cambios a tu repositorio (`git push origin feature/nueva-funcionalidad`).
5.  Abre un *pull request*.

## Licencia

Este proyecto está bajo la licencia [MIT](https://opensource.org/licenses/MIT). ```