## 1 = composer require hnova/rest dev-main => Des libreria rest para api

2 = composer require hnova/db dev-main => Des libreria para base de datos

3 = "scripts":{
        "nv" : "HNova\\Rest\\Scripts\\script::execute"
    } =>

4 = composer nv i => Ejecuta la instalacion

5 = composer nv env => Estrablecer variables de entrono base de datos

6 = composer dump-autoload => actualiza el auto load cuando crear un nuevo name spaces en el psr 4 de composer.json