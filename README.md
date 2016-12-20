# MBT_Web

This is the Webserver for MBT.  Created in December 2016 (the year of the suck)


## Getting Started

Why do i need to tell you?

### Prerequisites (Homestead setup)

setup yo webserver:

```
    - map: mbtweb.dev
      to: /home/vagrant/Code/[THISPACKAGEDIR]/public

```
and a database

```
    - mbt

```

### Installing


```
Composer Update
```


```
php artisan migrate
```

set up your .env with these items:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mbt
DB_USERNAME=homestead
DB_PASSWORD=secret
```
only change this to another server if you intend on installing it on 2 servers
```
AUTH_SERVER=http://mbtweb.dev
```
```
GOOGLE_ID=xxx
GOOGLE_SCECRET=xxx
GOOGLE_REDIRECT=http://mbtweb.dev/callback/google

FACEBOOK_ID=xxx
FACEBOOK_SCECRET=xxx
FACEBOOK_REDIRECT=http://mbtweb.dev/callback/facebook
```

## Breakdown

the `social Auth Controller` represents the items on the `webserver`
the `JWTAuthController` represents the items on the `Authentication server`
the `TestController` shows a Response of the user when a correct JWT is supplied `API`

### Web Server
connect to `mbtweb.dev`
redirect you to the social lagin page for the service
then receives the `callback` and the `service's token`
User is redirected to the `Authentication Server` for the JWT Token

### Authentication Server
Receives the `service's token`
Authenticates the `service token` with the `service` to get the `service ID`
Looks up the `user` by `service ID`
If user doesnt exist, they are created.
Takes the `User` and makes a `JWT`
Returns the `JWT`

### API (Test Controller)

sending a GET request to /test with a header containing:
`Authorization:Bearer [JWT HERE]`
will return the user from the database

## Authors

* **Shawn Dalton** - *All the work* 


## Acknowledgments

* Jefferson
* Inspiration
* etc