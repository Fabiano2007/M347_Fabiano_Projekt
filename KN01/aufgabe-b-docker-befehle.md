# Verwendete Docker-Befehle

## Version anzeigen
docker --version

## Images suchen
docker search ubuntu
docker search nginx

## Getting-Started Container starten
docker run -d -p 80:80 docker/getting-started

## Nginx Image herunterladen, Container erstellen und starten
docker pull nginx
docker create -p 8081:80 nginx
docker start <container-id oder name>

## Ubuntu Container starten (Hintergrund und interaktiv)
docker run -d ubuntu
docker run -it ubuntu

## Interaktive Shell in laufendem Container öffnen
docker exec -it <nginx-container-name> /bin/bash
# Alternativ, falls bash nicht verfügbar:
docker exec -it <nginx-container-name> /bin/sh

## Statusdienst anzeigen
service nginx status

## Shell verlassen
exit

## Container-Status anzeigen
docker ps -a

## Container stoppen
docker stop <container-id oder name>

## Alle Container löschen
docker rm $(docker ps -a -q)

## Images löschen
docker rmi nginx
docker rmi ubuntu
