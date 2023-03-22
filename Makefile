deploy:
	npm run build
	git add .
	git commit -m ":construction: Work in progress"
	git push

CONSOLE = symfony console

entity:
	symfony console make:entity

user:
	symfony console make:user

db-reset:
	make rm-migrations
	make db-drop
	make db-create
	make db-migrate
	make db-migration
	make db-fixtures
	make cc

rm-migrations:
	rm -rf migrations/*

db-drop:
	symfony console doctrine:database:drop --if-exists --force

db-create:
	symfony console doctrine:database:create --if-not-exists

db-migration:
	symfony console doctrine:migration:migrate -n

db-migrate:
	symfony console make:migration -n

db-fixtures:
	symfony console doctrine:fixtures:load -n

cc: ## Apply cache clear
	symfony console cache:clear

buildasset:
	npm run build

gadd:
	git add .

gwip:
	git commit -m ":construction: Work in progress"

gpush:
	git push

gquick:
	make cc
	make buildasset
	make gadd
	make gcommit
	make gpush


