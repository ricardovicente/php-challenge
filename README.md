Instructions
------------
To configure the application environment.

Installation
------------

### Clone the repository

````bash
$ git clone https://github.com/ricardovicente/php-challenge.git
````

### Install Laravel vendors

````bash
$ composer install
````

### Install node_modules

````bash
$ npm install && npm run dev
````

Important details
-----

In the "php-challenge_app_1" container, execute the commands:

````bash
$ docker exec -it php-challenge_app_1 bash
````
Inside the container:

````bash
$ chmod -Rf 777 bootstrap
$ chmod -Rf 777 storage
$ php artisan migrate
````

API
------------

For all endpoints use:

````
Authentication Bearer <token>
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

Return
````json
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
    "updated_at": "2020-12-14T10:26:31.000000Z",
    "people": [
        {
            "original_id": 1,
            "name": "User 1",
            "person_phones": [
                {
                    "number": "1134551010"
                },
                {
                    "number": "1656511012"
                }
            ]
        }
    ]
}
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
