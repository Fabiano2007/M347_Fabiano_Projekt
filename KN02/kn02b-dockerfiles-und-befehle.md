# Aufgabe KN02b – Dockerfile II


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
docker build -t fabiano4392/m347:kn02b-db .
docker run -d --name kn02b-db fabiano4392/m347:kn02b-db
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
docker build -t fabiano4392/m347:kn02b-web .

# Vor dem Start sicherstellen, dass alter Container gelöscht ist
docker stop kn02b-web
docker rm kn02b-web

docker run -d --name kn02b-web --link kn02b-db:kn02b-db -p 8083:80 fabiano4392/m347:kn02b-web
```

---

## 🧪 Tests & Screenshots

- [x] `http://localhost:8083/info.php` → zeigt PHP-Info
- [x] `http://localhost:8083/db.php` → zeigt „Verbindung erfolgreich!“
- [x] Screenshot von beiden Seiten
- [x] Screenshot: `docker exec -it kn02b-web telnet kn02b-db 3306`

![Screenshot 2025-05-26 133853](https://github.com/user-attachments/assets/53893c96-ed82-4767-81a8-9af25c7ae81b)
![Screenshot 2025-05-26 134406](https://github.com/user-attachments/assets/1e42fbcf-92da-430f-9f55-3d5b3820410c)
![Screenshot 2025-05-26 134108](https://github.com/user-attachments/assets/ce0a27c2-c424-47b0-a975-2605341a757e)


---

## 📤 Push der Images

```bash
docker push fabiano4392/m347:kn02b-db
docker push fabiano4392/m347:kn02b-web
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
