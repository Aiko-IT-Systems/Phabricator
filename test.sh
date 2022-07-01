#!/bin/bash
CMD="apc apcu bz2 calendar ctype curl date dom excimer exif fileinfo filter ftp gd gettext hash iconv imap json ldap libxml mailparse mbstring mysqli mysqlnd openssl pcntl pcre pdo_mysql posix readline session shmop sockets sodium standard sysvmsg sysvsem sysvshm tokenizer xml xmlreader xmlwriter xsl zip zlib"
INSTALL_CMD=""

for value in $CMD
do
	 INSTALL_CMD+="php-$value "
done

echo $INSTALL_CMD
