Simply set $cfg['ExecTimeLimit'] = 0; In xampp/phpMyAdmin/libraries/config.default.php.

Maximum execution time in seconds (0 for no limit).

And make this below changes in php.ini file as per file size.

post_max_size = 600M 
upload_max_filesize = 500M 
max_execution_time = 5000 
max_input_time = 5000 
memory_limit = 600M


https://stackoverflow.com/questions/11294812/how-to-change-xampp-apache-server-port

2. Edit the file "httpd.conf"

This file should be found in C:\xampp\apache\conf on Windows or in bin/apache for Linux.:

Listen 80
ServerName localhost:80
Replace them by:

Listen 8012
ServerName localhost:8012

3. Edit the file "http-ssl.conf"
This file should be found in C:\xampp\apache\conf\extra on Windows or see this link for Linux.

Locate the following lines:

Listen 443
<VirtualHost _default_:443>
ServerName localhost:443
Replace them by with a other port number (8013 for this example) :

Listen 8013
<VirtualHost _default_:8013>
ServerName localhost:8013



## To Update xampp php
https://www.youtube.com/watch?v=wtgiEluCbhc

## To download update xampp version
https://sourceforge.net/projects/xampp/files/

## To Download the Microsoft Drivers for PHP for SQL Server
https://docs.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server?view=sql-server-ver15