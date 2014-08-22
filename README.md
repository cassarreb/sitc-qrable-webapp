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

* PHP (5.3+ recommended)
* web server (such as Apache web server)
* MYSQL

For development purposes, one may use a stack such as XAMPP or KSWeb (for Android).

## Database setup

DDL script is provided in the `` config `` folder under the name `` sitc.sql ``. 
Please, run this script to generate all the tables you need.

In the following subsections you will find what data is expected to be present 
in any one table and any manipulations that the app may perform:

### stand

To be storing information about QR points.

Example input:

* `` standref `` - `` NULL ``
* `` qrcode `` - `` 'ICTSA treasure hunt' ``
* `` funfact `` - `` 'Treasure hunts are fun!' ``

### codes

To be holding token-redeeming codes which are to be output by the app whenever 
user collects 10 QR codes and the limit of winners has not been reached.

Example input:

* `` code `` - `` 'chiwawwa' ``

### current_code

To keep track of what codes have been consumed. App increments the code_id value 
for every win.

No value need to be changed for this table as the DDL takes care of that for you 
with a single record holding the value 1.

### player

To keep track of every player's progress. App takes care of that itself so don't 
tamper with it, unless you know what you're doing. Once 10 QR codes are collected, 
the player is allowed to play again since he has already won.

## Web app hosting

The `` webroot `` folder contains all files to be hosted.

Both client and server should be hosted on the same domain, unless CORS is enabled 
on server. Please follow the guide for your web server software in the event you 
opt for hosting the server on some other end-point.

It is also recommended to minify the supplied JavaScript and CSS files using some 
tool such as http://gpbmike.github.io/refresh-sf/.
