

fichier .env:

relier la bdd avec wamp

```
DATABASE_URL=mysql://root:@127.0.0.1:3306/annimaux?serverVersion=5.7
```

**dans phpMyAdmin:**

utilisateur:root

mdp: pas de mot de passe

(ne pas utiliser localhost dans ce cas)

pour creer la base de données:

```
bin/console doctrine:database:create
```



créer une table:

```
bin/console make:entity Animal
```

creer l'entity animal avec:

```
bin/console make:entity Animal
```

puis choisir les colonnes directement en console.



**faire la migration pour avoir la répercuttion sur la bdd**

créer le fichier qui va permettre de faire la migration:

```
php bin/console make:migration
```

un fichier se cré dans migration.



lance la table ou autre en dbb:

```
php bin/console doctrine:migrations:migrate
```



**<u>chap 27 fixture créer des données:</u>**

->intaller le module

```
composer require --dev orm-fixtures
```

->créer une fixture pour notre entity animal

```
bin/console make:fixtures AnimalFixtures
```

dans le fichier AnimalFixtures:

```php


<?php



namespace App\DataFixtures;



use App\Entity\Animal;

use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\Fixture;



class AnimalFixtures extends Fixture

{

  public function load(ObjectManager $manager)

  {

​    $a1 = new Animal();

​    $a1->setNom("Chien")

​    ->setDescription("un gentil toutout")

​    ->setImage("chien.png")

​    ;

​    $manager->persist($a1);



​    $a5 = new Animal();

​    $a5->setNom("Cochon")

​    ->setDescription("groin groin")

​    ->setImage("cochon.png")

​    ;

​    $manager->persist($a5);



​    $a3 = new Animal();

​    $a3->setNom("Serpent")

​    ->setDescription("un animal dangereux")

​    ->setImage("serpent.png")

​    ;

​    $manager->persist($a3);



​    $a4 = new Animal();

​    $a4->setNom("Crocodile")

​    ->setDescription("un animal très dangereux")

​    ->setImage("croco.png")

​    ;

​    $manager->persist($a4);



​    $a5 = new Animal();

​    $a5->setNom("Requin")

​    ->setDescription("un animal marin très danger")

​    ->setImage("chien.png")

​    ;

​    $manager->persist($a5);





​    $manager->flush();

  }

}


```



->lancer la création de données

```
bin/console doctrine:fixture:load
```

**<u>28: page d'acceuil</u>**

création du controller:

```
bin/console make:controller AnimalController
```

dans base...

  pour le style on est aller le chercher sur bootwatch (sandstone), 

```
  <link rel="stylesheet" href="https://bootswatch.com/4/sandstone/bootstrap.min.css">
```



fichier bas.html.twig:

```twig
<!DOCTYPE html>

<html>

  <head>

        <meta charset="UTF-8">

​    <title>{% block title %}Welcome!{% endblock %}</title>

​    <link rel="stylesheet" href="https://bootswatch.com/4/sandstone/bootstrap.min.css">

​    {% block stylesheets %}{% endblock %}

  </head>

  <body>

​    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

            <a class="navbar-brand" href="{{path('animaux')}}">Animaux</a>

​      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">

​        <span class="navbar-toggler-icon"></span>

​      </button>



            <div class="collapse navbar-collapse" id="navbarColor02">

​        <ul class="navbar-nav mr-auto">

​          <li class="nav-item active">

                        <a class="nav-link" href="{{path('animaux')}}">Accueil</a>

​          </li>

​        </ul>

​      </div>

​    </nav>

​    <h1 class="border boreder-dark rounded p-2 m-2 text-white bg-primary">{% block monTitre %}{% endblock %}</h1>

​    {% block body %}{% endblock %}

​    

​    {% block javascripts %}{% endblock %}

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  </body>

</html>
```

<u>**29-Lister les animaux**</u>

le controller:



```php
  public function index()

  {

​    $repository = $this->getDoctrine()->getRepository(Animal::class);

​    $animaux = $repository->findAll();



​    return $this->render('animal/index.html.twig',[

​      "lesAnimaux" => $animaux

​    ]);

  }
```



<u>**avec injection de dépendance:**</u>

on réccupère l'objet directement dans les paramètres de la fonction.

```php
  use App\Repository\AnimalRepository;


public function index(AnimalRepository $repository)

  {

​    $animaux = $repository->findAll();



​    return $this->render('animal/index.html.twig',[

​      "lesAnimaux" => $animaux

​    ]);

  }

}
```



boucle for pour la vue:

```twig
{% for animal in lesAnimaux %}

        <div class="row align-items-center">

            <div class="col-2 text-center">

                <img src="{{asset('images/' ~ animal.image)}}">

​      </div>

            <div class="col-auto">

​        <h2>{{ animal.nom }}</h2>

                <div>{{ animal.description }}</div>

​      </div>

​    </div>

  {% endfor %}
```



**<u>31 la page d'un animal:</u>**

**controller:**

```php
public function afficherAnimal(AnimalRepository $repository ,$id)

  {

​    $animal = $repository->find($id);



​    return $this->render('animal/afficherAnimal.html.twig',[

​      "unAnimal" => $animal

​    ]);

  }
```

**modification avec le converter:**

 le converter sait qu'il doit aller chercher l'id dans le repository.

```php
 public function afficherAnimal(Animal $animal)

  {


​    return $this->render('animal/afficherAnimal.html.twig',[

​      "unAnimal" => $animal

​    ]);

  }
```

**vue afficher un animal:**

```twig
{% block body %}

<div class="row align-items-center">

    <div class="col-2 text-center">

        <img src="{{asset('images/' ~ unAnimal.image)}}">

  </div>

    <div class="col-auto">

            <div>Description: {{ unAnimal.description }}</div>

            <div>Poids: {{ unAnimal.poids }}</div>

            <div>Dangereux:

​      {% if unAnimal.dangereux %}

​        <span class="badge badge-danger">OUI</span>

​      {% else %}

​        <span class="badge badge-success">NON</span>

​      {% endif %}

​      </div>

  </div>



</div>





{% endblock %}
```

```css
<span class="badge badge-danger">OUI</span>
```

pertmet d'afficher du rouge ou du vert.



**32 relation 1.N**

créer l'entité famille:

```
 bin/console make:entity Famille
```



générer fichier migration:

```
bin/console make:migration
```

migration en base:

```
$ bin/console doctrine:migration:migrate
```

mettre les données fixture en base:

```
bin/console doctrine:fixtures:load
```



**35.continent**

Pour supprimer une entitée on suprrime les fichiers correspondant tout simplement.

Avec le AddContinent il y a deux actions qui sont faites en une. Le continent est ajouté à l'animal et l'animal au continent. On aurait pu partir sur AddAnimal dans l'ajout du continent dans les fixtures c'est équivalent.



**38 relation N.N** (entre personne et animal)

-> créé l'entité personne qui possede un nom

-> on a déja l'entité animal

-> on crée l'entité dispose 



<u>ajouter dans Dispose.php</u>

```
 \* @UniqueEntity(fields={"personne","animal"})
```

