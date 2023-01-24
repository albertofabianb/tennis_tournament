# tennis_tournament

Esto es solo un ejercicio que muestra el diseño según lor requerimientos y está hecho para describir los motivos de tal implementación como también las tantas otras formas de hacerlo.

Esta desarrollado en Laravel 8, tiene su estructura de base de datos en los archivos de migración y el seed para los jugadores, 8 hombres y 8 mujeres.
Está incompleto, ya que para ser un challenge es demasiado largo por, y lo que pretendo es de forma oral explicar detalladamente cómo se hace lo que falta.

El archivo "Geopagos-Tenis.dia" muestra la estructura de la BD para ser abierto con la aplicación Dia, tambien adjunto una imagen con el mismo nombre, "Geopagos-Tenis.png".

Los Sets (grupo de 6 games) no fueron implementados aunque sí fueron pensados, para simplicidad, los resultados se dan por partido (Match).
Preferí enviarlo así en lugar de no enviar nada.

Se debe instalar de la siguiente manera: 
Descargar el repositorio
1. Ejecutar "composer install"
2. Se debe configurar el archivo ".env" para apunte a una BD MySql con una base de datos llamada "tenis".
3. Correr "php artisan migrate --seed"

