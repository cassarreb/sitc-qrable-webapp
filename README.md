QRable
======

This is an app to be presented by ICTSA at Science in the City 2014. 
Development is led by Daniel Desira, and any outside contributions should 
have an issue that is approved. Also, all code contributions will be 
primarily examined by the subject.

Derivatives of this work are allowed as long as the GPL license is preserved 
and respected.

Thanks!

## Prerequisites

* PHP
* web server (Apache web server)
* MYSQL

For development purposes, one may use a stack such as XAMPP or KSWeb.

## Database setup

DDL script is provided in config folder under the name sitc.sql. Please, run 
this script to generate all the tables you need.

In the following subsections you will find what data is expected to be present 
in any one table and any manipulations that the app may perform:

### stand

To be storing information about QR points.

### codes

To be holding token-redeeming codes which are to be output by the app whenever 
user collects 10 QR codes and the limit of winners has not been reached.

Example input:

* code - 'chiwawwa'

### current_code

To keep track of what codes have been consumed. App increments the code_id value 
for every win.