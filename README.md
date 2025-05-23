# Sistema Laboratorio

## Instalación

- Clonamos el repositorio

```sh
git clone https://github.com/ccjuantrujillo/laboratorio.git
```

- Instalamos las dependencias de PHP

```sh
composer install
```

- Instalamos dependencias NPM

```sh
npm ci
```

- Construimos el assets

```sh
npm run dev
```

- Instalamos el archivo de configuracion y configuramos la base de datos

```sh
cp .env.example .env
```

- Generamos una llave para la aplicacion

```sh
php artisan key:generate
```

- Ejecutamos las migraciones

```sh
php artisan migrate
```

- Ejecutamos los seeders

```sh
php artisan db:seed
```

- Ejecutamos el servidor

```sh
php artisan serve
```

- Ingresamos al sistema con el siguiente usuario

- **Username:** johndoe@example.com
- **Password:** secret
