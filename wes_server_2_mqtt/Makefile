DC_PREFIX=wes_server

up:
	make docker.up
	sleep 10
	make supervisor.run
stop: docker.stop
down: docker.down

ssh: ## Run bash shell on the "bash" container (user www-data)
	$(call docker-compose,exec ha bash)

supervisor.run: ## Run bash shell on the "bash" container (user www-data)
	$(call docker-compose,exec --user=root ha bash supervisor_run)

###
### PLATFORM
### ¯¯¯¯¯¯¯¯

define docker-compose
	docker-compose -p ${DC_PREFIX} $(1)
endef

docker.up: ## Start the docker containers
	$(call docker-compose,up -d)
.PHONY: docker.up

docker.stop: ## Stop the docker containers
	$(call docker-compose,stop)
.PHONY: docker.stop

docker.destroy: ## Destroy the containers, volumes, networks…
	$(call docker-compose,down -v --remove-orphans)

docker.down: ## Stop and remove the docker containers
	$(call docker-compose,down)
.PHONY: docker.down

.PHONY: logs
docker.logs: ## Show containers logs
	$(call docker-compose,logs -f)
