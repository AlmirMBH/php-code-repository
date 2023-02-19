<?php

/**
 * Apache configuration file
 * usr/local/apache2/conf/httpd.conf
 * usr/local/apache2/logs
 * var/log/httpd 
 * 
 * XAMPP 
 * ServerRoot "C:/xampp/apache" - root directory of the website
 * Liste 80 - default port
 * <IfModule unixd_module> - if present, other directives can be included e.g. ServerAdmin postmaster@localhost,
 * ServerName localhost:80
 * 
 * <Directory>
 * <Directory "C:/xampp/htdocs">
 * If directives are placed in the main configuration file outside of the sections, they aply to
 * the entire server. However, the directives can be scoped and enclosed in sections to be aplied to only
 * specific parts of the server.
 * The directive below denies access to the entire file system on the server. The 2nd directive below allows
 * access to specific directories.
 * <Directory />
 *      All override none
 *      Require all denied
 * </Directory>
 * <Directory "C:/xampp/htdocs">
 * 
 * Directive to deny access to specific file types
 * <Files ".ht*">
 *      Require all denied
 * </Files>
 * 
 * Default location of the error log file
 * ErrorLog "logs\error.log"
 * 
 * INCLUDES
 * Enable inclusion of other configuration files, so that it is easy to maintain the server configuration.
 * Include conf/extra/httpd-autoindex.conf
 * Include conf/extra/httpd-languages.conf
 * Include conf/extra/httpd-vhosts.conf - enables configuration of multiple websites on the same server by using
 * virtual host scope directive
 * 
 * HTACCESS FILES
 * Do not use htaccess files, unless there is a very good reason for including them because they are read on
 * every request, which can impact the server's performance.
 * Use htaccess files in case of share hosting i.e. not all users can modify the configuration file. Another
 * case is when url rewriting is required in some places. The url rewriting configuration file is included
 * into the main configuration file but its access is controlled via htacccess file.
 */

