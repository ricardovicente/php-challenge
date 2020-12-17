Instructions
------------
To configure the application environment.

Installation
------------

### Clone the repository

````
$ git clone https://github.com/ricardovicente/php-challenge.git
````

### Star Docker

````
$ docker-compose start
````

### Install Laravel vendors

````bash
$ composer install
````

### Generate .env

````
$ cp .env.example .env
````

### To execute Tests

````
$ php artisan test
````

Important details
-----


In the "php-challenge_app_1" container, execute the commands:

````
$ docker exec -it php-challenge_app_1 bash
````
Inside the container:

````bash
$ chmod -Rf 777 bootstrap
$ chmod -Rf 777 storage
$ php artisan key:generate
$ php artisan migrate
````

It is necessary to leave the queue monitor started to perform the process of importing the files:

````bash
$ php artisan queue:work
````
- - -
WEB LOCALHOST
------------

To access the web system, use the URL below and make a new registration:
````
http://localhost:8080/register
````

Then just log in normally
````
http://localhost:8080/
````

WEB ONLINE
------------

````
http://invillia.activelab.com.br/
````

- - -
API
------------

For all endpoints use:

````
Authentication Bearer <token>
````

To have your token, access the system with your email and password. Then, go to the profile menu and access the "API Tokens" option
````
http://localhost:8080/user/api-tokens
````


*Me Endpoint* - Returns all user data

````
http://localhost:8080/api/me
````
Return
````json
{
    "id": 1,
    "name": "Full Name",
    "email": "my@mail.com",
    "email_verified_at": null,
    "current_team_id": null,
    "profile_photo_path": null,
    "created_at": "2020-12-10T10:10:10.000000Z",
    "updated_at": "2020-12-10T10:10:10.000000Z",
    "profile_photo_url": "https://ui-avatars.com/api/?name=Full+Name&color=7F9CF5&background=EBF4FF"
}
````

*File Endpoint* - Returns all Files

````
http://localhost:8080/api/files
````
Return
````json
[
    {
        "id": 1,
        "user_id": 1,
        "original_name": "people.xml",
        "stored_path": "xmls/2020/12/14/08-12-31_fb299fc2-9062-4c95-acb5-ea4430bf8367.xml",
        "size": "528.00B",
        "records": 0,
        "type": "people",
        "status": "uploading",
        "created_at": "2020-12-14T10:26:31.000000Z",
        "updated_at": "2020-12-14T10:26:31.000000Z"
    },
    {
        "id": 2,
        "user_id": 1,
        "original_name": "shiporders.xml",
        "stored_path": "xmls/2020/12/14/08-12-53_4a5a063f-3be5-481a-93e5-1fc4bc7342c2.xml",
        "size": "1.30KB",
        "records": 0,
        "type": "shiporders",
        "status": "waiting",
        "created_at": "2020-12-14T10:26:53.000000Z",
        "updated_at": "2020-12-14T10:26:53.000000Z"
    },
    {
        "id": 3,
        "user_id": 1,
        "original_name": "people.xml",
        "stored_path": "xmls/2020/12/14/08-12-00_5b29ade4-7d6f-4bbe-bfdb-0d5a1c1b7176.xml",
        "size": "528.00B",
        "records": 0,
        "type": "people",
        "status": "progress",
        "created_at": "2020-12-14T11:14:00.000000Z",
        "updated_at": "2020-12-14T11:18:00.000000Z"
    },
    {
        "id": 4,
        "user_id": 1,
        "original_name": "shiporders.xml",
        "stored_path": "xmls/2020/12/14/08-12-42_2cc5c41a-36e7-4f91-bd53-38078b443c4f.xml",
        "size": "1.30KB",
        "records": 1000,
        "type": "shiporders",
        "status": "processed",
        "created_at": "2020-12-14T11:16:42.000000Z",
        "updated_at": "2020-12-14T15:35:00.000000Z"
    }
]
````

*File Endpoint* - Returns all Files

````
http://localhost:8080/api/files/{id}/items
````

````
http://localhost:8080/api/files/923dcebc-7a89-48f3-a0b1-92380e59e5a6/items
````

Return PERSON Collection
````json
[
    {
        "id": 1,
        "user_id": 1,
        "original_name": "people.xml",
        "stored_path": "xmls/2020/12/15/22-12-18_a84ebe94-5a97-4490-8b79-16ac416fb629.xml",
        "size": "528.00B",
        "records": 3,
        "type": "people",
        "status": "processed",
        "created_at": "2020-12-15T01:52:19.000000Z",
        "updated_at": "2020-12-15T01:52:44.000000Z",
        "person": [
            {
                "id": 1,
                "file_id": 1,
                "original_id": "1",
                "name": "Name 1",
                "created_at": "2020-12-15T05:13:52.000000Z",
                "updated_at": "2020-12-15T05:13:52.000000Z",
                "person_phone": [
                    {
                        "id": 1,
                        "person_id": 1,
                        "number": "2345678"
                    },
                    {
                        "id": 2,
                        "person_id": 1,
                        "number": "1234567"
                    }
                ]
            },
            {
                "id": 2,
                "file_id": 1,
                "original_id": "2",
                "name": "Name 2",
                "created_at": "2020-12-15T05:13:52.000000Z",
                "updated_at": "2020-12-15T05:13:52.000000Z",
                "person_phone": [
                    {
                        "id": 3,
                        "person_id": 2,
                        "number": "4444444"
                    }
                ]
            },
            {
                "id": 3,
                "file_id": 1,
                "original_id": "3",
                "name": "Name 3",
                "created_at": "2020-12-15T05:13:53.000000Z",
                "updated_at": "2020-12-15T05:13:53.000000Z",
                "person_phone": [
                    {
                        "id": 4,
                        "person_id": 3,
                        "number": "7777777"
                    },
                    {
                        "id": 5,
                        "person_id": 3,
                        "number": "8888888"
                    }
                ]
            }
        ],
        "ship_order": []
    }
]
````

Return SHIP ORDER Collection
````json
[
    {
        "id": "923f19e1-fb1f-4137-aab9-3aca56632086",
        "user_id": 1,
        "original_name": "shiporders.xml",
        "stored_path": "xmls/2020/12/15/22-12-28_be5aa173-6790-4149-863c-e1cecf1af7d9.xml",
        "size": "1.30KB",
        "records": 3,
        "type": "shiporders",
        "status": "processed",
        "created_at": "2020-12-15T01:52:28.000000Z",
        "updated_at": "2020-12-15T01:52:44.000000Z",
        "person": [],
        "person": [],
        "ship_order": [
            {
                "id": 6,
                "file_id": 5,
                "person_id": 1,
                "original_id": "1",
                "created_at": "2020-12-15T05:21:31.000000Z",
                "updated_at": "2020-12-15T05:21:31.000000Z",
                "ship_to": [
                    {
                        "id": 4,
                        "ship_order_id": 6,
                        "name": "Name 1",
                        "address": "Address 1",
                        "city": "City 1",
                        "country": "Country 1"
                    }
                ],
                "ship_item": [
                    {
                        "id": 6,
                        "ship_order_id": 6,
                        "title": "Title 1",
                        "note": "Note 1",
                        "quantity": 745,
                        "price": 123.45
                    }
                ]
            },
            {
                "id": 7,
                "file_id": 5,
                "person_id": 2,
                "original_id": "2",
                "created_at": "2020-12-15T05:21:31.000000Z",
                "updated_at": "2020-12-15T05:21:31.000000Z",
                "ship_to": [
                    {
                        "id": 5,
                        "ship_order_id": 7,
                        "name": "Name 2",
                        "address": "Address 2",
                        "city": "City 2",
                        "country": "Country 2"
                    }
                ],
                "ship_item": [
                    {
                        "id": 7,
                        "ship_order_id": 7,
                        "title": "Title 2",
                        "note": "Note 2",
                        "quantity": 45,
                        "price": 13.45
                    }
                ]
            },
            {
                "id": 8,
                "file_id": 5,
                "person_id": 3,
                "original_id": "3",
                "created_at": "2020-12-15T05:21:31.000000Z",
                "updated_at": "2020-12-15T05:21:31.000000Z",
                "ship_to": [
                    {
                        "id": 6,
                        "ship_order_id": 8,
                        "name": "Name 3",
                        "address": "Address 3",
                        "city": "City 3",
                        "country": "Country 3"
                    }
                ],
                "ship_item": [
                    {
                        "id": 8,
                        "ship_order_id": 8,
                        "title": "Title 3",
                        "note": "Note 3",
                        "quantity": 5,
                        "price": 1.12
                    },
                    {
                        "id": 9,
                        "ship_order_id": 8,
                        "title": "Title 3",
                        "note": "Note 3",
                        "quantity": 5,
                        "price": 1.12
                    },
                    {
                        "id": 10,
                        "ship_order_id": 8,
                        "title": "Title 4",
                        "note": "Note 4",
                        "quantity": 2,
                        "price": 77.12
                    }
                ]
            }
        ]
     }
]
````


Stack
------------

- PHP
- Laravel 8
- Jetstream
- Livewire
- Fortify
- Sanctum
- MySQL
- Queues

Extra Packages
------------

- lang pt-BR
- dbal
- prewk/xml-string-streamer
