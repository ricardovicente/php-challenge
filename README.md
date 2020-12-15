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
        "id": "923dcebc-7a89-48f3-a0b1-92380e59e5a6",
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
        "id": "923dcede-d87d-4ffc-8e62-89da9f0ec3f0",
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
        "id": "923dca43-74da-46ad-8375-a5bb6bcecdd5",
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
        "id": "923dcb39-e7fc-48db-8b02-bfb0b90b4f4e",
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
        "id": "923f19d3-ca0a-43ed-82ad-22609f1b11b4",
        "user_id": 1,
        "original_name": "people.xml",
        "stored_path": "xmls/2020/12/14/22-12-18_a84ebe94-5a97-4490-8b79-16ac416fb629.xml",
        "size": "528.00B",
        "records": 3,
        "type": "people",
        "status": "processed",
        "created_at": "2020-12-15T01:52:19.000000Z",
        "updated_at": "2020-12-15T01:52:44.000000Z",
        "person": [
            {
                "id": "923f19fb-017c-4829-baf5-e767c09a05f7",
                "file_id": "923f19d3-ca0a-43ed-82ad-22609f1b11b4",
                "original_id": "1",
                "name": "Name 1",
                "created_at": "2020-12-15T01:52:44.000000Z",
                "updated_at": "2020-12-15T01:52:44.000000Z",
                "person_phone": [
                    {
                        "id": "923f19fb-0552-4854-aefe-a18e41a01078",
                        "person_id": "923f19fb-017c-4829-baf5-e767c09a05f7",
                        "number": "2345678",
                        "created_at": "2020-12-15T01:52:44.000000Z",
                        "updated_at": "2020-12-15T01:52:44.000000Z"
                    }
                ]
            },
            {
                "id": "923f19fb-0a1a-43c2-acbf-2480c7d8ddc7",
                "file_id": "923f19d3-ca0a-43ed-82ad-22609f1b11b4",
                "original_id": "2",
                "name": "Name 2",
                "created_at": "2020-12-15T01:52:44.000000Z",
                "updated_at": "2020-12-15T01:52:44.000000Z",
                "person_phone": [
                    {
                        "id": "923f19fb-0c9b-4c65-89be-7da11ee90da9",
                        "person_id": "923f19fb-0a1a-43c2-acbf-2480c7d8ddc7",
                        "number": "4444444",
                        "created_at": "2020-12-15T01:52:44.000000Z",
                        "updated_at": "2020-12-15T01:52:44.000000Z"
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
        "stored_path": "xmls/2020/12/14/22-12-28_be5aa173-6790-4149-863c-e1cecf1af7d9.xml",
        "size": "1.30KB",
        "records": 3,
        "type": "shiporders",
        "status": "processed",
        "created_at": "2020-12-15T01:52:28.000000Z",
        "updated_at": "2020-12-15T01:52:44.000000Z",
        "person": [],
        "ship_order": [
            {
                "id": "923f19fb-1b60-4aa9-8d31-dcffeb32d3ff",
                "file_id": "923f19e1-fb1f-4137-aab9-3aca56632086",
                "person_id": "923f19fb-017c-4829-baf5-e767c09a05f7",
                "original_id": "1",
                "created_at": "2020-12-15T01:52:44.000000Z",
                "updated_at": "2020-12-15T01:52:44.000000Z",
                "ship_to": [
                    {
                        "id": "923f19fb-1cdc-4375-88e4-81eb5b404e78",
                        "ship_order_id": "923f19fb-1b60-4aa9-8d31-dcffeb32d3ff",
                        "name": "Name 1",
                        "address": "Address 1",
                        "city": "City 1",
                        "country": "Country 1",
                        "created_at": "2020-12-15T01:52:44.000000Z",
                        "updated_at": "2020-12-15T01:52:44.000000Z"
                    }
                ],
                "ship_item": [
                    {
                        "id": "923f19fb-1e6f-4414-b1a7-3363f7d8dad1",
                        "ship_order_id": "923f19fb-1b60-4aa9-8d31-dcffeb32d3ff",
                        "title": "Title 1",
                        "note": "Note 1",
                        "quantity": 745,
                        "price": 123.45,
                        "created_at": "2020-12-15T01:52:44.000000Z",
                        "updated_at": "2020-12-15T01:52:44.000000Z"
                    }
                ]
            },
            {
                "id": "923f19fb-25a2-46d3-a949-8068915036f8",
                "file_id": "923f19e1-fb1f-4137-aab9-3aca56632086",
                "person_id": "923f19fb-0fea-49c8-a268-0635ec932ae8",
                "original_id": "3",
                "created_at": "2020-12-15T01:52:44.000000Z",
                "updated_at": "2020-12-15T01:52:44.000000Z",
                "ship_to": [
                    {
                        "id": "923f19fb-271a-44fa-b654-3617ca33423a",
                        "ship_order_id": "923f19fb-25a2-46d3-a949-8068915036f8",
                        "name": "Name 3",
                        "address": "Address 3",
                        "city": "City 3",
                        "country": "Country 3",
                        "created_at": "2020-12-15T01:52:44.000000Z",
                        "updated_at": "2020-12-15T01:52:44.000000Z"
                    }
                ],
                "ship_item": [
                    {
                        "id": "923f19fb-285c-467c-af4a-f8181039e81c",
                        "ship_order_id": "923f19fb-25a2-46d3-a949-8068915036f8",
                        "title": "Title 3",
                        "note": "Note 3",
                        "quantity": 5,
                        "price": 1.12,
                        "created_at": "2020-12-15T01:52:44.000000Z",
                        "updated_at": "2020-12-15T01:52:44.000000Z"
                    },
                    {
                        "id": "923f19fb-2a73-45e0-af8e-11a049ac5354",
                        "ship_order_id": "923f19fb-25a2-46d3-a949-8068915036f8",
                        "title": "Title 4",
                        "note": "Note 4",
                        "quantity": 2,
                        "price": 77.12,
                        "created_at": "2020-12-15T01:52:44.000000Z",
                        "updated_at": "2020-12-15T01:52:44.000000Z"
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
