# ramverk1-project

[![Build Status](https://travis-ci.com/sandraKh/ramverk1-project.svg?branch=main)](https://travis-ci.com/sandraKh/ramverk1-project)


För att kunna installera detta projekt och köra det själv så laddar man först ner repot.

```
https://github.com/sandraKh/ramverk1-project.git
```

Uppdatera composer 
```
$ composer update
```

Och installera verktygen som behövs 

```
$ make install
```

Kör sedan följande kommandon för att skapa databasen.

```
$ mkdir data
$ chmod 777 data
$ touch data/db.sqlite
$ chmod 666 data/db.sqlite
$ sqlite3 data/db.sqlite < sql/ddl/ddl_sqlite.sql
```
