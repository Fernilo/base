[![Build Status](https://www.syloper.com/wp-content/themes/v2018/img/logo-header.svg?style=flat-square)](https://www.syloper.com)

# Bienvenido


Proyecto creado con  [CakePHP](https://cakephp.org) 3.8.
Versión de PHP recomendada 7.222222gdfgdfgdfgdfgdf

## Instalación

1. Clonar su repositorio en local.
2. Instalar la aplicación `composer install` (Si no tiene [Composer](https://getcomposer.org/)).
    2. 1. Si se va instalar en un servidor de producción, se recomienda el uso de `composer install --no-dev`, para evitar instalar dependecias de desarrollo.


### Problemas con la instalación
- **VERSION DE PHP:** Si surge algún problema con la versión de PHP del servidor, instalar la aplicación usando `composer install --ignore-platform-reqs`
Si sigue dando problemas probar actualizar las dependencias con `composer update --with-dependencies`

- **PHP.INI:** Puede pasar casos en que se deba subir a un servidor ajeno al nuestro y el php.ini no tenga las configuraciones necesarias, para eso entramos al cpanel (o el panel que sea) y cambiamos las configuraciones de php.ini desde allí.
Si los cambios no se reflejan se puede forzar desde la linea de comandos: 
    - suponiendo que queremos habilitar `allow_url_fopen`
`which composer`  -> no se devuelve la ruta donde esta instalado
`php -d allow_url_fopen=on <ruta_composer> install`



## Configuración

1. Crear la base de datos.
2. Configurar la base de datos en `config/app.php`
3. Copiar el archivo `.htaccess_default` en la misma posicion y renombrarlo como `.htaccess`
4. Correr las migraciones

```bash
bin/cake migrations migrate
```
5. Generar las semillas con el usuario administrador por defecto.

```bash
bin/cake migrations seed
```

Ahora puede usar el servidor web de su máquina para ver la página de inicio predeterminada ó iniciar el servidor web incorporado en cakePHP con:

```bash
bin/cake server
```

Luego visite `http://localhost:8765` para ver la página de bienvenida.

## Configuración de E-mail
La configuración para el envió de email desde el servidor se hace en el archivo `config/app.php` en la sección **"EmailTransport"** la información para completar sera dada por el servidor.
Cualquier duda consultar la [documentación](https://book.cakephp.org/3/en/core-libraries/email.html)
**Aclaración:** Es posible que para xampp no funcione el envió de email y se requiera alguna configuración especial del xampp.


## Docker

En el caso de no tener Xampp instalado o que se tenga inconvenientes con su funcionamiento, se puede recurrir a correr el proyecto sobre docker.
Docker debe estar instalado y corriendo en el Sistema Operativo.

**Instalar docker en Manjaro:** 
- Seguir los pasos de esta [WEB](https://manjaro.site/how-to-install-docker-on-manjaro-18-0/)

**Instalar docker en Ubuntu:** 
- [Documentación docker](https://docs.docker.com/install/linux/docker-ce/ubuntu/)
- [Tutorial digitalocean](https://www.digitalocean.com/community/tutorials/como-instalar-y-usar-docker-en-ubuntu-18-04-1-es)

Una vez instalado, asegurarse de tener "docker-compose" instalado. Estando dentro de la carpeta del proyecto, ir al archivo "docker-compose.yml" y configurar el nombre de la base de datos. Hecho esto se puede usar los sig. comandos:

1. Levantar el servidor con `docker-compose up --build -d`
    - Proyecto accesible desde http://localhost:8080/
    - PhpMyAdmin en http://localhost:8081/
2. Ver listado de contenedores `docker ps -a`
2. Entrar a la consola de un contenedor con: `docker exec -it <NOMBRE_CONTENEDOR> /bin/bash`
3. Detener docker con: `docker-compose down`

### Uso de la consola de Cake (bin/cake) en Docker
Al estar el proyecto corriendo dentro de un contenedor, hay 2 opciones para la utilización de la consola de Cake:
- **Opción 1:** Acceder por consola al contenedor con `docker exec -it <NOMBRE_CONTENEDOR> /bin/bash` y ejecutar los comandos de cake con normalidad.
- **Opción 2:** Ejecutar `bin/bash` en reemplazo del comando `bin/cake`.



## VSCode
### Configuración
Hay subida a este repo una carpeta oculta que se llama .vscode_default adentro contiene un archivo settings con las configuraciones de la mayoria de los plugins a continuación solo tenes que renombrar la carpeta `.vscode_default` por `.vscode` para que empiecen a hacer efecto.
### Plugins recomendados para VSCode
- Ortografía
    - Code Spell Checked
    - Spanish - Code Spell Checked
- PHP
    - PHP Extension Pack (incluye PHP IntelliSense y PHP Debug)
    - PHP Intelephense
    - PHP DocBlocker
- JS y CSS
    - JS & CSS Minifier (Minify)
- JS
    - //ver
- CSS
    - //ver
- GIT
    - GitLens 
