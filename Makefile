.PHONY: help up down ps logs restart sh-php sh-mysql artisan composer migrate seed fresh-seed mysql table test

DC = docker compose

help:
	@echo "Available targets:"
	@echo "  make up            # Build and start containers"
	@echo "  make down          # Stop and remove containers"
	@echo "  make ps            # Show container status"
	@echo "  make logs          # Follow all service logs"
	@echo "  make restart       # Restart services"
	@echo "  make sh-php        # Open shell in php container"
	@echo "  make sh-mysql      # Open shell in mysql container"
	@echo "  make artisan cmd='route:list'   # Run artisan command"
	@echo "  make composer cmd='install'     # Run composer command"
	@echo "  make migrate       # Run migrations"
	@echo "  make seed          # Run seeders"
	@echo "  make fresh-seed    # Fresh migrate and seed"
	@echo "  make mysql         # Open mysql client"
	@echo "  make table         # Show mysql tables"
	@echo "  make test          # Run Laravel tests"

up:
	$(DC) up -d --build

down:
	$(DC) down

ps:
	$(DC) ps

logs:
	$(DC) logs -f

restart:
	$(DC) restart

sh-php:
	$(DC) exec php sh

sh-mysql:
	$(DC) exec mysql sh

artisan:
	$(DC) exec php php artisan $(cmd)

composer:
	$(DC) exec php composer $(cmd)

migrate:
	$(DC) exec php php artisan migrate

seed:
	$(DC) exec php php artisan db:seed

fresh-seed:
	$(DC) exec php php artisan migrate:fresh --seed

mysql:
	$(DC) exec mysql mysql -usail -ppassword laravel

table:
	$(DC) exec mysql mysql -usail -ppassword laravel -e "SHOW TABLES;"

test:
	$(DC) exec php php artisan test
