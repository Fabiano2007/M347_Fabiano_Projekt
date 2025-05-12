# Aufgabe D: Privates Repository (20%)

## Verwendete Docker-Befehle

```bash
# nginx Image herunterladen
docker pull nginx:latest

# Image taggen für eigenes Repository
docker tag nginx:latest BENUTZERNAME/m347:nginx

# In privates Repository pushen
docker push BENUTZERNAME/m347:nginx

# mariadb Image herunterladen
docker pull mariadb:latest

# Image taggen für eigenes Repository
docker tag mariadb:latest BENUTZERNAME/m347:mariadb

# In privates Repository pushen
docker push BENUTZERNAME/m347:mariadb
```

---

## Erklärung der Befehle

### `docker pull nginx:latest`
Lädt das aktuelle öffentliche nginx-Image von Docker Hub herunter.

### `docker tag nginx:latest BENUTZERNAME/m347:nginx`
Erstellt einen neuen Tag für das nginx-Image. Das bedeutet, es wird unter dem neuen Namen im lokalen System referenziert. Dieser neue Tag verweist auf das gleiche Image, aber mit einem neuen Repository-Pfad.

### `docker push BENUTZERNAME/m347:nginx`
Sendet das getaggte Image ins private Repository bei Docker Hub. Voraussetzung: Man ist bei Docker eingeloggt und hat Schreibrechte auf das Repository.

### `docker pull mariadb:latest`
Lädt das öffentliche mariadb-Image in aktueller Version.

### `docker tag mariadb:latest BENUTZERNAME/m347:mariadb`
Taggt das mariadb-Image mit einem neuen Namen und speichert es lokal.

### `docker push BENUTZERNAME/m347:mariadb`
Pusht das Image mit dem mariadb-Tag ins private Repository `m347`.

---

