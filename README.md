# Addiëlla AMOUZOUN P8

Améliorez une application existante de ToDo & Co - Openclassrooms projet 8

[![Codacy Badge]([https://app.codacy.com/project/badge/Grade/bf6901d6bba1451195c22c5935e45356)](https://app.codacy.com/gh/acecconato/AnthonyCecconato_8_21072023/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade](https://app.codacy.com/gh/alleidda/P8ToDoListApp/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade))


## Get startedhttps://github.com/alleidda/P8ToDoListApp/tree/main

Clone the repository on your environment
```console
git clone https://github.com/alleidda/P8ToDoListApp.git
cd P8ToDoListApp
```

Next it's recommanded to copy the .env to a .env.local file
```console
cp .env .env.local
```

In the .env.local file you will find a `DATABASE_URL` value. Actually we are using a postgresql database by default, which is started with a
Docker ccontainer in the following steps. But you can use your own database such as MySQL or SQLite. You will find more options here: https://symfony.com/doc/current/doctrine.html#configuring-the-database

## Dependencies

### Install composer and npm dependencies

**Composer**
```console
composer install
```

**npm**
```console
npm install
```

### Build the assets

For dev environment:
```console
npm run dev
```

For prod environment:
```console
npm run build
```

## Create the database, generate schemas and load fixtures

After configuring the database connexion in the .env.local file, you can create the database with
```console
php bin/console doctrine:database:create

Then run the migrations
```console
php bin/console doctrine:migration:migrate


Finally, you can load the fixtures:
```console
php bin/console doctrine:fixture:load

## Start the application
```console
symfony serve
```


## Demo accounts

User :
- id: demo
- pass: demo

Administrator: 
- id: admin
- pass: demo


