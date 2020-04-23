

fichier .env:

relier la bdd avec wamp

```
DATABASE_URL=mysql://root:@127.0.0.1:3306/annimaux?serverVersion=5.7
```

pour creer la base de données:

```
bin/console doctrine:database:create
```



créer une table:

```
bin/console make:entity Animal
```

