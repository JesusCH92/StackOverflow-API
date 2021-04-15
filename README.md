# Objetivo

El objetivo de este proyecto es desarrollar un endpoint que permita obtener datos de las preguntas de los foros de Stack Overflow utilizando la siguiente API publica

* [**URL API**](https://api.stackexchange.com/docs/questions)

Esta nueva API tiene los siguientes filtros:
* tagged: Filtro obligatorio.
* to_date: Filtro opcional.
* from_date: Filtro opcional


# Requisitos del sistema

Para realizar este proyecto se trabajó con el stack de Symfony y Nginx, esto fue montado en un entorno dockerizado, así que es necesario tener instalado:
* Docker (Docker-compose)

# Ejecución del proyecto

## **Linux o Mac**
Si está trabajando con un S.O. de la familia de Unix (Linux o Mac), puede ejecutar lo siguiente:

**1. Deploy Project**

Primero debe ejecutar este comando para desplegar el proyecto:
```
make deploy
```

**2. Ejecutar los tests**

Si ya ha desplegado el proyecto, puede ejecutar los tests ejecutando el siguiente comando:
```
make run-test
```

## **Windows**

Si está trabajado con windows, siga los siguientes pasos:

**1. Crear una red**

Primero cree la network:
```shell
docker network create stackoverflow-network
```

**2. Levantar el entorno**

El siguiente paso es levantar el entorno con este comando:
```.bash
U_ID=(id -u) docker-compose up -d
```

**3. Instalar las dependecias**

Por último, instale las dependencias:
```
U_ID=(id -u) docker exec --user $(id -u) -it php-fpm composer install --no-scripts --no-interaction --optimize-autoloader
```

**4. Ejecutar los tests**

Opcionalmente se puede ejecutar los test una vez ya se haya desplegado el proyecto con los pasos anteriores:
```
U_ID=(id -u) docker exec --user $(id -u) -it php-fpm php bin/phpunit --testdox
```

# Funcionalidad

Una vez desplegado el proyecto, puede acceder al sistema.
Ejemplos del uso del sistema:

**API con todos los filtros**

* http://localhost:8080/api?tagged=js&from_date=2021-03-27&to_date=2021-03-29

**API con un filtro opcional**

* http://localhost:8080/api?tagged=js&to_date=2021-03-29

**API solo con el filtro obligatorio**

* http://localhost:8080/api?tagged=js

