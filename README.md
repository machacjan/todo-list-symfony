# Todo List Symfony

Simple todo list app written using [Symfony](https://github.com/symfony/symfony) framework in a Docker container based on [Symfony Docker](https://github.com/dunglas/symfony-docker) repository. This repository was created as a showcase for my coding standards and best practices.

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+).
2. Run `make init` or use the plain commands in Makefile if you don't have Make support.
3. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334).
4. (Optional) You can disable the security message by using one of the commands from the next section.

## Trusting the Authority

With a standard installation, the authority used to sign certificates generated in the Caddy container is not trusted by your local machine. You must add the authority to the trust store of the host:

### MacOS
```
$ docker cp $(docker compose ps -q caddy):/data/caddy/pki/authorities/local/root.crt /tmp/root.crt && sudo security add-trusted-cert -d -r trustRoot -k /Library/Keychains/System.keychain /tmp/root.crt
```
### Linux
```
$ docker cp $(docker compose ps -q caddy):/data/caddy/pki/authorities/local/root.crt /usr/local/share/ca-certificates/root.crt && sudo update-ca-certificates
```
### Windows
```
$ docker compose cp caddy:/data/caddy/pki/authorities/local/root.crt %TEMP%/root.crt && certutil -addstore -f "ROOT" %TEMP%/root.crt
```
