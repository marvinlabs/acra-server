acra-server
===========

A server to collect crash data of your android applications

## Current features

- Email notification on new crash
- Grouping of similar crashes into "issues"
- Dashboard for all applications with some statistics
- Dashboard for a single application with some statistics

## Demo

There is a demo server running (with very few crashes halas, we are looking for crash data to feed this DB): http://acra-server-demo.marvinlabs.com/dashboard

## Installation

The app can be installed on your server using two methods: 

1. by uploading a complete zip file and manually creating the database (requires FTP and database access)
2. by installing the Symfony framework first and then this bundle (requires command line access to git, php and composer on your server)

### For people just having FTP and DB access

- Download the application including the Symfony framework from http://www.vincentprat.info/tmp/acra-server-1.0.0.zip
- Upload the zip content on your server
- Give permissions `777` to directories `app/logs` and `app/cache`
- Create the DB tables with the help from the file `create-schema.sql` included in the ZIP
- Copy the `app/config/parameters.yml.dist` file to `app/config/parameters.yml`
- Make your (sub-)domain point to the directory acra-server/web
- Edit `app/config/parameters.yml` to enter the connection details to your database server and the email addresses for notifications
- If all is fine, you should be able to access the app at http://www.yourdomain.com/dashboard

If you are seeing the page with screwed CSS and/or some Javascript errors, you might need to run a PHP command on your server:

    php app/console assetic:dump --env=prod --no-debug
    
If you have a solution to get rid of that extra-step, I have opened a question on [StackOverflow](http://stackoverflow.com/questions/16800653/creating-a-ready-to-use-symfony-2-application-zip)


### For people comfortable with Symfony 

This app is nothing more than a regular Symfony bundle and can be installed as such (I am no Symfony expert, feel free to give your feedback on that install procedure):

- Install the bundle from gitHub (git://github.com/marvinlabs/acra-server.git) on your server
- Give permissions 777 to directories app/logs and app/cache
- Run composer to install the Symfony framework
- Copy the `app/config/parameters.yml.dist` file to `app/config/parameters.yml`
- Edit `app/config/parameters.yml` to enter the connection details to your database server and the email addresses for notifications
- Run the php commands to setup the project:

// If the DB is not created

    php app/console doctrine:database:create --env=prod 
    
// Create the DB tables

    php app/console doctrine:schema:create --env=prod
    
// Prepare the CSS and JS

    php app/console assets:install --env=prod --no-debug
    php app/console assetic:dump --env=prod --no-debug

- If all is fine, you should be able to access the app at http://www.yourdomain.com/dashboard
