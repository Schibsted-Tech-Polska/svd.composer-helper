# Composer Helper
## Url Parser
This tool is very useful to split one env variable with uri i.e. to database like `mysql://user:password@host/database_name` and save it to separate env variables. It is useful to split parameters on heroku. 

### Instalation
Add to composer json:
```json
"schibsted-tech-polska/svd-composer-helper": "~1.0"
```

### Usage
Add the folowing configuration to your composer.json file:
```json
"svd-composer-helper": {
    "parse-url": {
        "DATABASE_URI": {
            "env-map": {
                "host": "DATABASE_HOST",
                "pass": "DATABASE_PASSWORD",
                "path": "DATABASE_DBNAME",
                "port": "DATABASE_PORT",
                "user": "DATABASE_USER"
            }
        }
    }
}
```
The `DATABASE_URI` is env variable which you want to split.


If you want to trin database name add `"trim-path": true` under `DATABASE_URI`. It should look like this:
```json
"svd-composer-helper": {
    "parse-url": {
        "DATABASE_URI": {
            "env-map": {
                "host": "DATABASE_HOST",
                "pass": "DATABASE_PASSWORD",
                "path": "DATABASE_DBNAME",
                "port": "DATABASE_PORT",
                "user": "DATABASE_USER"
            },
            "trim-path": true
        }
    }
}
```
