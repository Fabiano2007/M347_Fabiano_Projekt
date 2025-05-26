# Aufgabe KN02b – Dockerfile II

## Ziel
Erstellung eines Datenbank-Containers (MariaDB) und eines Web-Containers (PHP mit Apache), die über Docker miteinander vernetzt sind.

---

## 📁 Ordnerstruktur
```
kn02b-db/
  Dockerfile
kn02b-web/
  Dockerfile
  info.php
  db.php
```

---

## 🔹 Datenbank-Container

### 📄 `kn02b-db/Dockerfile`
```Dockerfile
FROM mariadb

ENV MYSQL_ROOT_PASSWORD=rootpw
ENV MYSQL_DATABASE=schule
ENV MYSQL_USER=webuser
ENV MYSQL_PASSWORD=webpw

EXPOSE 3306
```

### ⚙️ Befehle für Build & Run
```bash
cd kn02b-db
docker build -t fabiano123/m347:kn02b-db .
docker run -d --name kn02b-db fabiano123/m347:kn02b-db
```

---

## 🔹 Web-Container

### 📄 `kn02b-web/Dockerfile`
```Dockerfile
FROM php:8.0-apache

RUN docker-php-ext-install mysqli

COPY . /var/www/html

EXPOSE 80
```

### 📄 `info.php`
```php
<?php
phpinfo();
?>
```

### 📄 `db.php`
```php
<?php
$mysqli = new mysqli("kn02b-db", "webuser", "webpw", "schule");

if ($mysqli->connect_error) {
    die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
echo "Verbindung erfolgreich!";
?>
```

### ⚙️ Befehle für Build & Run
```bash
cd kn02b-web
docker build -t fabiano123/m347:kn02b-web .

# Vor dem Start sicherstellen, dass alter Container gelöscht ist
docker stop kn02b-web
docker rm kn02b-web

docker run -d --name kn02b-web --link kn02b-db:kn02b-db -p 8083:80 fabiano123/m347:kn02b-web
```

---

## 🧪 Tests & Screenshots

- [x] `http://localhost:8083/info.php` → zeigt PHP-Info
- [x] `http://localhost:8083/db.php` → zeigt „Verbindung erfolgreich!“
- [x] Screenshot von beiden Seiten
- [x] Screenshot: `docker exec -it kn02b-web telnet kn02b-db 3306`

---

## 📤 Push der Images

```bash
docker push fabiano123/m347:kn02b-db
docker push fabiano123/m347:kn02b-web
```

---

## Abgaben

- ✅ DB: Dockerfile
- ✅ DB: `docker build` und `docker run`
- ✅ Web: Dockerfile
- ✅ Web: `docker build` und `docker run`
- ✅ Web: `info.php` und `db.php`
- ✅ Screenshots von Webseiten
- ✅ Screenshot telnet-Verbindung zur DB