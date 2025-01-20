# BiblioCV - Sistema de Gestión de Currículums para Bibliotecas Municipales

## Descripción

BiblioCV es una plataforma web diseñada para facilitar la creación, gestión y revisión de currículums por parte de personas que frecuentan las bibliotecas municipales, especialmente dirigida a adultos mayores y personas con dificultades digitales. El sistema busca agilizar el proceso de creación de CVs, hacer más eficiente la colaboración entre las bibliotecas, y ofrecer un acceso unificado a las oportunidades laborales. 

Este proyecto está basado en Laravel 11 y MySQL, y tiene como objetivo principal mejorar el proceso manual actual que se lleva a cabo en las bibliotecas municipales de Chile.

## Características

- **Interfaz sencilla e intuitiva** para facilitar la creación de currículums por parte de usuarios no familiarizados con las herramientas digitales.
- **Base de datos centralizada** que permite gestionar y revisar currículums de manera colaborativa entre distintas sucursales de Biblioredes.
- **Herramientas de asistencia virtual** que guían al usuario durante el proceso de creación del CV.
- **Revisión de CVs** por parte de los funcionarios de las bibliotecas con posibilidad de colaboración en línea.
- **Conexión mediante RUT** para la revisión de currículums por parte de los usuarios de las bibliotecas.

## Tecnologías

Este proyecto está desarrollado utilizando las siguientes tecnologías:

- **PHP 8.4.2**
- **Laravel 11**
- **MySQL 8**
- **Composer 2.8.4**
- **Apache**

## Instalación

### Prerrequisitos

- Tener instalado **PHP** en la versión 8.4.2 o superior.
- Tener instalado **Composer** en la versión 2.8.4 o superior.
- Tener un servidor de base de datos **MySQL** 8 o superior.
- Apache o un servidor web compatible.

### Pasos de instalación

1. **Clonar el repositorio**

```bash
git clone https://github.com/fmendezy/bibliocv.git
cd bibliocv```

2. **Instalar dependencias**
Ejecuta el siguiente comando para instalar las dependencias de Laravel:

```bash
  composer install```

3. **Configurar el archivo** `.env`
Abre el archivo `.env ` y configura los parámetros de la base de datos:

```mysql
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bibliocv
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña```

4. **Generar la clave de la aplicación**
Ejecuta el siguiente comando para generar la clave de la aplicación:
```shell
php artisan key:generate```

5. **Migraciones de la base de datos**
Ejecuta las migraciones para crear las tablas necesarias en la base de datos:
```shell
php artisan migrate```

6. **Servir la aplicación**
Inicia el servidor de desarrollo de Laravel:
```shell
php artisan serve```
Ahora puedes acceder a la aplicación en tu navegador en `http://localhost:8000`

### Contribuciones
1. Si deseas contribuir al desarrollo de este proyecto, por favor sigue los siguientes pasos:
2. Haz un **fork** del repositorio.
3. Crea una nueva **rama** (`git checkout -b feature/nueva-funcionalidad`).
4. Realiza tus cambios y haz **commit** de ellos (`git commit -am 'Agrega nueva funcionalidad'`).
5. Sube tus cambios a tu repositorio (`git push origin feature/nueva-funcionalidad`).
6. Abre un **pull request**.
