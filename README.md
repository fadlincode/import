# import
This project just for research purpose on csv import using PHP

## installation
clone this project
```bash
  git clone https://github.com/fadlincode/import.git
```

## setup
first, open terminal / command prompt / powershell on this project, then run :
```bash
  composer update
```


then, setup your config on config/config.json : for set uuid, host, user, password, database, table & column
```bash
  {
    "connection": {
        "host": "", # set target hostname or ip_addresss
        "user": "", # set target database user
        "pass": "", # set target database password or left blank if use locals
        "database": "" # set target database name
    },
    "uuid": false, # set true for using auto generate uuid, false for not (Auto Increment)
    "separator" : ";", # set separator , it's ',' or ';'
    "table": "table_name", # set target table
    "column": [ # set all target column here
        "column1",
        "column2",
        "column3",
        "etc...",
    ]
  }
```

## requirements
- install composer : https://getcomposer.org/download/
