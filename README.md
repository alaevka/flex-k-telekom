
## Flex test app
"К Телеком" - конкурсе на вакансию Fullstack программиста:
Тестовое задание. Backend.

Установка:
```
composer install
```
Создайте новую базу данных.
Создайте файл конфигурации .env, для чего используйте пример из файла .env.example и установите параметры вашего окружения для базы данных и секретного ключа авторизации (параметр **JWT_SECRET**).

Секретный ключ и токен можно сгенерировать здесь: **http://jwtbuilder.jamiekurtz.com/** 


Выполните миграции и заполните БД тестовыми данными. 
```
php artisan migrate
php artisan db:seed --class=EquipmentType
php artisan db:seed --class=Equipment

```
Серийные номера тестовых данных оборудования формируются в соответствии с маской типов оборудования.

Методы АПИ:

```
GET:/api/equipment
GET:/api/equipment/{id}
POST:/api/equipment
PUT:/api/equipment/{id}
DELETE:/api/equipment/{id}
GET:/api/equipment-type
```

В заголовках запроса обязательно указывать:
```
Accept application/json
Authorization Bearer XXX - где XXX - токен, сгененрированный на основе секретного ключа, указанного выше в конфигурации
```

