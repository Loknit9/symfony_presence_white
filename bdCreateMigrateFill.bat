
@REM Pour effacer, creer et remplir la base de donnees
    echo yes | del migrations
symfony console doctrine:database:drop --force --no-interaction
symfony console doctrine:database:create --no-interaction
symfony console make:migration --no-interaction
symfony console doctrine:migration:migrate --no-interaction
@REM pour remplir la BD avec des fausses données
symfony console doctrine:fixtures:load --no-interaction
