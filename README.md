##Sistema de administración de Asignaturas y Laboratorios

###Requerimientos

 - Linux (Ubuntu, Debian o derivados)
 - PostgreSQL (crear usuario  y pass postgres, una base llamada *asignaturas*)
 - Git

    `sudo apt-get install git`

 - NodeJS (incluido npm)


      ` curl -sL https://deb.nodesource.com/setup_4.x | sudo -E bash -`
      
      ` sudo apt-get install -y nodejs`
      
      `sudo apt-get install -y build-essential`

 Instalar dependencias nodejs a utilizar
      `sudo npm install -g gulp bower`
 - PHP 5 +
 
     `sudo apt-get install php5 php5-pgsql`
 - Composer [Instalacion en Ubuntu hasta paso 2](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-14-04)
 
###Instalación

- Clonar repositorio

     `git clone https://github.com/Irvandoval/asignaturas.git`
- Entrar a la carpeta y actualizar dependencias Composer

     `cd asignaturas`
     `composer install`
     
     Contestar preguntas post instalacion: (espacios en blancos son ENTER)
     
     `database_driver (pdo_mysql): pdo_pgsql`
     
     `database_host (127.0.0.1): `
     
     `database_port (null): 5432`
     
    ` database_name (symfony): asignaturas`
    
     `database_user (root): postgres`
     
     `database_password (root): postgres`
     
     `mailer_transport (smtp): `
     
     `mailer_host (127.0.0.1):` 
     
     `mailer_user (null): `
     
     `mailer_password (null):` 
     
     `locale (en): es`
     
- Instalar dependencias node y bower

     `npm install`

     `bower install`
- Actualizar Schema Doctrine

     `php app/console doctrine:schema:create`
- Crear usuario y darle de alta

`php app/console fos:user:create
php app/console fos:user:activate`
- Correr servidor de pruebas

     `php app/console server:start`
- Agregar dependencias al index, copiar assets a la carpeta web, iniciar servidor Browser Sync (para que se actualize automaticamente el browser al haber cambios)

     `gulp serve`

Se abrirá la aplicación en Localhost:8000 en el navegador
- Detener los servicios basta con Ctrl + C y 

     `php app/console server:stop`

###Directorios importantes
- src/AppBundle --backend
- src/AppBundle/Resources/public --frontend Angular
