# Erklärungen zu den Docker-Befehlen

## docker --version
Zeigt die aktuell installierte Docker-Version.

## docker search <image>
Durchsucht Docker Hub nach Images mit dem eingegebenen Namen (z. B. "ubuntu", "nginx").

## docker run
Startet einen neuen Container.
- `-d`: detached mode – im Hintergrund laufen lassen.
- `-p <host-port>:<container-port>`: Portweiterleitung vom Host zum Container.
- `-it`: interaktive Shell (terminalfähig).
- `--name <name>`: gibt dem Container einen Namen.

## docker pull
Lädt ein Image manuell von Docker Hub herunter.

## docker create
Erstellt einen Container aus einem Image (führt ihn aber noch nicht aus).

## docker start
Startet einen zuvor erstellten (gestoppten) Container.

## docker exec -it <name> /bin/bash oder /bin/sh
Öffnet eine interaktive Shell in einem bereits laufenden Container.

## service nginx status
Zeigt den Status des nginx-Webservers im Container.

## docker ps -a
Zeigt alle Container – auch gestoppte.

## docker stop <name>
Stoppt einen laufenden Container.

## docker rm
Entfernt einen oder mehrere Container.

## docker rmi
Löscht ein oder mehrere lokale Images.
