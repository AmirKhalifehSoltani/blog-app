#### In The Name Of God

# Blog-App Using Laravel 10, php 8.2
and also mysql8, blade, tailwindcss, ...


## Table of Contents

### 1. [How to Deploy](#how-to-deploy?)
### 2. [Design](#design)
### 3. [Potential Improvements](#potential-improvements)

## How to Deploy?

Run following command for project deployment
```
1. git clone git@github.com:AmirKhalifehSoltani/blog-app.git

2. cd blog-app

3. cp .env.example .env

4. docker-compose build app

5. docker-compose up -d

6. docker exec -it laravel-container bash

7. composer install

8. php artisan key:generate

9. php artisan migrate

10. php artisan db:seed

11. php artisan test
```

Blog App project now is running on [localhost:8000](http://localhost:8000)

### How to login?

You can login with following credentials those are seeded to the database.

Admin:
 - email: `admin@alibaba.ir`, password: `password`

Clients:
 - email: `client1@alibaba.ir`, password: `password`
 - email: `client2@alibaba.ir`, password: `password`

## Design

- This project has 2 main user types: **Admin** & **Client**. These 2 user-types extend abstract user model.
Authentication is implemented with 2 **separated guards** for each user-type.
- **Service pattern** fully is implemented for ArticleControllers
- **Unit tests** are written for article service classes.
- **Trash feature** for articles is also implemented
- Using **php 8.0** and above features

## Potential Improvements

- This codebase could be more clean with implementing **Repository design pattern** to keep service classes clean and reuse eloquent queries. Additionally we can **decorate repositories with cache layer** due to boost application speed.
- **DTOs** could be used to make the project more type-safe and improve code reuseability
- Blade components improvement

