# Addiëlla AMOUZOUN P8
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/d033359d69fb4797afb5223840e073e9)](https://app.codacy.com/gh/alleidda/P8ToDoListApp/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)
Améliorez une application existante de ToDo & Co - Openclassrooms projet 8


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


