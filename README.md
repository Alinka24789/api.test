# Test RESTfull API 
 
## Установка приложения

 1. Загрузите проект с репозитория ```git clone https://github.com/Alinka24789/api.test.git``` в папку сайта.
 2. В командной строке в папке проекта запустите команду ```composer install```, а после ```composer update```.
 3. В файле ```.env``` необходимо прописать конфигурации подключения к базе данных
```php
    DB_HOST=localhost
	DB_DATABASE=db_name
	DB_USERNAME=user_name
	DB_PASSWORD=password
```
	
 4. В командной строке в папке проекта выполнить миграции: ```php artisan migrate```
 5. Далее необходимо зарегистрировать тестового пользователя, для этого необходимо перейти по ссылке ```'/register'``` (должны получить ```{ email => test@test.com, password => password }```).
 6. Перейдя на главную страницу ```'/'``` необходимо авторизироваться для получения токена.

## Использование API

### Работа с категориями

 1. Получить все категории: 

	```GET http://<domain>/v1/categories?access_token=<access_token>```

 2. Получить отсартированные категории:

	```GET http://<domain>/v1/categories?sort=<ASC|DESC>&access_token=<access_token>```

 3. Получить конкретную категорию:

	```GET http://<domain>/v1/categories/{id}?access_token=<access_token>```
	
 4. Добавить категорию:

	```POST http://<domain>/v1/categories```
	
	Поля:
```php
	[
	  'access_token' => <access_token>
          'name' => 'Название категории'
	]
```

 5. Изменить категорию:

	```PUT http://<domain>/v1/categories/{id}```
	
```php
        Поля:
	[
	  'access_token' => <access_token>
          'name' => 'Новое название категории'
	]
```

 6. Удалить категорию: 

  ```DELETE http://<domain>/v1/categories/{id}?access_token=<access_token>```

 Работа с продуктами

 1. Получить весь список продуктов:

 	```GET http://<domain>/v1/products?access_token=<access_token>```

 2. Получить конкретный продукт:

	```GET http://<domain>/v1/products/{id}?access_token=<access_token>```

 3. Получить продукт по категории:

	```GET http://<domain>/v1/categories/{categori_id}/products/{product_id}?access_token=<access_token>```

 4. Добавить продукт: 

    ```POST http://<domain>/v1/products```
	
	Поля:
```php
	[
	  'access_token' => <access_token>
          'name' => 'Название продукта',
	  'category_id' => 'ID категории'
	]
```

 5. Изменить продукт:

	```PUT http://<domain>/v1/products/{id}```

  Поля:
```php
	[
	  'access_token' => <access_token>
          'name' => 'Название продукта',
	  'category_id' => 'ID категории'
	]
```

 6. Удалить продукт: 

 ```DELETE http://<domain>/v1/products/{id}?access_token=<access_token>```
