# AUTO CLEAN - Sistema de citas, agendas y servicios para el taller Auto Clean
> Sistema de apoyo para el control de citas, agends y servicios para los clientes, tecnicos y adminitradores en el taller AutoClean

## Necesidad

Todas las operaciones de registro y agendamiento del taller se realizaron mediante formularios y fichas impresas. Con el objetivo de reducir el volumen de papel utilizado en estas operaciones, así como solicitar y notificar los servicios que realiza el tecnico a cargo, se solicitó mediante el estudio de caso practico un sistema que optimizara estas acciones.

## Herramientas utilizadas

Para elaborar este sistema se utilizó Scriptcase v9.0, un entorno de desarrollo enfocado en PHP. Como herramientas auxiliares se utilizo XAMPP para aprender el lenguaje PHP. Visual Studio Code para manipulación y análisis de archivos HTML, Javascript y CSS, utilizado de forma auxiliar a Scriptcase, además de Mozilla Firefox y Google Chrome para pruebas de compatibilidad entre navegadores.

Por ello se debe instalar el aplicativo de XAMPP para la ejecucion del sistema en un servidor local, posterior se debe descomprimir el zip de este repositorio en la carpeta "htdocs", y para su ingreso se debe emitir el enlace local seguido se "/AUTO-CLEAN"

## Base de datos

El RDBMS utilizado fue MySQL, manipulado a través de phpmyadmin tanto para elaborar el modelo relacional como para crear la BD que albergará los datos del sistema. El código DB se puede encontrar en el directorio "\sql".

La base de datos se debe instalar en el servidor local de XAMPP para su correcta funcionalidad, asi como tambien la conexion a la base de datos por medio de el enlace del servidor local a la aplicacion con ek directorio del aplicativo seguide de "_lib/prod".

## Funcionalidades

El sistema permite:

* Registrar clientes,tecnicos y servicios;
* Registrar citas,agendas y dias de trabajo con horarios;
* Consultar agendas;
* Actualizar datos del cliente y sus servicios;
* Registrar usuarios (administrador,cliente,tecnico);
* Consultar datos de usuario;
* Registro de servicios realizados y por realizar;
* Consultar la citas con su agenda;
* Rellenar el estado de agenda (Estado de la cita y servicios, Historial del estado de agenda y facturas);
* Emisión de documentos (Facturas);
* Cambiar el correo electrónico y la contraseña de los usuarios.
* Notificar via correo electronico el estado la agenda;
* Notificar via correo electronico los datos de la agenda;

## Autores,programadores y creadores

* Giovanny Montenegro;
