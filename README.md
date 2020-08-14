# CodeIgniter 4 Auth Admin Template Application Starter

## CodeIgniter 4
https://github.com/codeigniter4/CodeIgniter4.git

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.
    ```bash
    database.default.hostname = localhost
    
    database.default.database = ci4starter
    
    database.default.username = root
    
    database.default.password = root
    
    database.default.DBDriver = MySQLi
    ```
## Server Requirements

PHP version 7.2 or higher is required, with the following extensions insalled: 

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)

# Myth-Auth
https://github.com/lonnieezell/myth-auth.git
## Myth-Auth Template Location

File Location [Project-Folder]/app/ThirdParty/myth-auth

### Installation

- **Via Composer**

    ```bash
    git clone https://github.com/lonnieezell/myth-auth.git app/ThirdParty/myth-auth
    ```
    ```bash
    composer update
    ```

### Configuration

Once installed you need to configure the framework to use the **Myth\Auth** library.
In your application, perform the following setup: 

1. Edit **app/Config/Email.php** and verify that a **fromName** and **fromEmail** are set 
    as that is used when sending emails for password reset, etc. 

2. Edit **app/Config/Validation.php** and add the following value to the **ruleSets** array: 
    `\Myth\Auth\Authentication\Passwords\ValidationRules::class`

3. Ensure your database is setup correctly, then run the Auth migrations: 

    > php spark migrate -all  

NOTE: This library uses your application's cache settings to reduce database lookups. If you want
to make use of this, simply make sure that your are using a cache engine other than `dummy` and 
it is properly setup. The `GroupModel` and `PermissionModel` will handle caching and invalidation
in the background for you.


# AdminLTE 3
https://github.com/ColorlibHQ/AdminLTE.git

## Admin Template Location

File Location [Project-Folder]/vendor/almasaeed2010/adminlte

### Installation

- **Via Composer**

    ```bash
    composer require "almasaeed2010/adminlte=~3.0"
    ```
    ```bash
    composer update
    ```
- **Copy Dist and Plugin**
    ```bash
    Copy Dist and Plugin From vendor/almasaeed2010/adminlte To [Project-Folder]/public 
    ```
