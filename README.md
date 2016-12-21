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
AUTH_SERVER=http://mbtauth.dev
```
```
GOOGLE_ID=xxx
GOOGLE_SCECRET=xxx
GOOGLE_REDIRECT=http://mbtweb.dev/callback/google

FACEBOOK_ID=xxx
FACEBOOK_SCECRET=xxx
FACEBOOK_REDIRECT=http://mbtweb.dev/callback/facebook
```

## Authors

* **Shawn Dalton** - *All the work so far* 


## Acknowledgments

* Jefferson
* Tessa and Samantha