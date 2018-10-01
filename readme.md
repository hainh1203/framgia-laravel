# framgia-laravel

## Build Status

[![Build Status](https://civ3.framgia.vn/api/badges/thinhhung/framgia-laravel/status.svg)](https://civ3.framgia.vn/repository/thinhhung/framgia-laravel/detail/overview)

## Preparation

### Installing Docker

The Docker installation package available in the official Ubuntu 16.04 repository may not be the latest version. To get the latest and greatest version, install Docker from the official Docker repository. This section shows you how to do just that.

First, add the GPG key for the official Docker repository to the system:
```sh
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
```

Add the Docker repository to APT sources:
```sh
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
```

Next, update the package database with the Docker packages from the newly added repo:
```sh
sudo apt-get update
```

Make sure you are about to install from the Docker repo instead of the default Ubuntu 16.04 repo:
```sh
apt-cache policy docker-ce
```

Finally, install Docker:
```sh
sudo apt-get install -y docker-ce
```

Docker should now be installed, the daemon started, and the process enabled to start on boot. Check that it's running:
```sh
sudo systemctl status docker
```

References:
- https://docs.docker.com/install/linux/docker-ce/ubuntu/#upgrade-docker-after-using-the-convenience-script
- https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-16-04

### Installing Docker Compose

Run this command to download the latest version of Docker Compose:
```sh
sudo curl -L "https://github.com/docker/compose/releases/download/1.22.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
```

Apply executable permissions to the binary:
```sh
sudo chmod +x /usr/local/bin/docker-compose
```

Test the installation.
```sh
docker-compose --version
```

References:
- https://docs.docker.com/compose/install/#install-compose

## Development

### Setting up development environment

Copy config files
```sh
cp docker-compose.dev.yml docker-compose.yml
cp .env.dev.example .env
```

Start docker containers
```sh
docker-compose up -d
```

Install dependences, migrate, and seed data
```sh
docker-compose exec workspace composer install --dev --no-interaction
docker-compose exec workspace php artisan migrate --seed
```

Generate application encryption key
```
docker-compose exec workspace php artisan key:generate
```

### Working

Test before sending a pull request
```sh
sh test.sh
```

Enter the docker workspace container
```sh
docker-compose exec workspace bash
```

Online Services:

- Website: http://0.0.0.0:8000/
- Adminer (Database Management Tool): http://0.0.0.0:8080/

## Production

Copy config files
```sh
cp docker-compose.prod.yml docker-compose.yml
cp .env.example .env
```

Edit the .env file

Start docker containers
```sh
docker-compose up -d
```

Install dependences, migrate, and seed data
```sh
docker-compose exec workspace composer install --no-interaction
docker-compose exec workspace php artisan migrate --seed
```

Generate application encryption key
```
docker-compose exec workspace php artisan key:generate
