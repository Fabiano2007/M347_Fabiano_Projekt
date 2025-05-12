# Aufgabe A – Dockerfile I (KN02)

## 🧾 Dokumentiertes Dockerfile

```Dockerfile
# Nutzt das offizielle nginx Image als Basis
FROM nginx

# Setzt das Arbeitsverzeichnis auf das Standard-Webverzeichnis von nginx
WORKDIR /usr/share/nginx/html

# Kopiert die HTML-Datei helloworld.html ins Arbeitsverzeichnis
COPY helloworld.html .

# Öffnet Port 80 für den Webzugriff
EXPOSE 80
```

---

## ⚙️ Verwendete Docker-Befehle

```bash
# Wechsel in Projektverzeichnis mit Dockerfile und helloworld.html
cd kn02a-dockerfile

# Image erstellen mit korrektem Repository-Tag für Docker Hub
docker build -t fabiano4392/m347:kn02a .

# Push zu Docker Hub
docker push fabiano4392/m347:kn02a

# Container starten (Port 8082 → 80 im Container)
docker run -d -p 8082:80 fabiano4392/m347:kn02a
```

---

## 📖 Erklärung der Befehle

| Befehl | Beschreibung |
|--------|--------------|
| `docker build -t fabiano4392/m347:kn02a .` | Erstellt ein neues Image basierend auf dem Dockerfile im aktuellen Verzeichnis mit dem Tag `kn02a` im privaten Repository |
| `docker push fabiano4392/m347:kn02a` | Überträgt das Image ins private Docker Hub Repository `m347` |
| `docker run -d -p 8082:80 fabiano4392/m347:kn02a` | Startet einen Container aus dem Image im Hintergrund und mappt Port 8082 auf Port 80 im Container |

---

## 🖼️ Abgaben

- [x] Dokumentiertes Dockerfile (siehe oben)
- [x] Dockerfile mit Anweisungen: `FROM`, `WORKDIR`, `COPY`, `EXPOSE`
- [x] Verwendete Docker-Befehle mit Tag und Build
- [x] Screenshot von Docker Desktop mit dem Image `kn02a`
- [x] Screenshot der HTML-Seite unter `http://localhost:8082/helloworld.html`
