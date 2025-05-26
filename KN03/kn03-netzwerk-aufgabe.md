# KN03 – Aufgabe A: Eigenes Netzwerk (100%)

## 🎯 Ziel
Untersuchung von Docker-Container-Netzwerken anhand von BusyBox-Containern im Default-Netzwerk und einem benutzerdefinierten Netzwerk `m347-net`.

---

## 📦 Netzwerkaufbau

### 🔧 Netzwerk erstellen
```bash
docker network create --subnet=172.18.0.0/16 m347-net
```

---

### 🧱 Container starten

#### Default Bridge Netzwerk:
```bash
docker run -dit --name busybox1 busybox
docker run -dit --name busybox2 busybox
```

#### Benutzerdefiniertes Netzwerk:
```bash
docker run -dit --name busybox3 --net m347-net --ip 172.18.0.3 busybox
docker run -dit --name busybox4 --net m347-net --ip 172.18.0.4 busybox
```

---

## 🧪 Netzwerkdiagnose

### 🔍 IP-Adressen prüfen
```bash
docker exec -it busybox1 ifconfig
docker exec -it busybox2 ifconfig
docker exec -it busybox3 ifconfig
docker exec -it busybox4 ifconfig
```

Alternativ:
```bash
docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' busybox1
```

---

### 📡 Verbindungstest (Ping)

#### Von `busybox1`:
```bash
ping busybox2              # ❌ bad address
ping busybox3              # ❌ bad address
ping 172.18.0.3            # ❌ 100% packet loss
```

#### Von `busybox3`:
```bash
ping busybox4              # ✅ 0% packet loss (gleiches Netzwerk)
ping busybox1              # ❌ bad address
ping 172.17.0.2            # ❌ 100% packet loss
```

---

## 🌐 Default Gateway prüfen
```bash
docker exec -it busybox1 route
docker exec -it busybox3 route
```

---

## ✅ Analyse & Fazit

| Test                                | Ergebnis         | Erklärung |
|-------------------------------------|------------------|-----------|
| busybox3 → busybox4 (Name)          | ✅ Erfolgreich   | Beide im `m347-net` |
| busybox1 → busybox2 (Name)          | ❌ bad address   | Kein DNS im default bridge |
| busybox1 → 172.18.0.3               | ❌ Kein Zugriff  | Kein Routing zwischen default und custom network |
| busybox3 → 172.17.0.2               | ❌ Kein Zugriff  | Kein Routing zwischen Netzwerken |

---

## 📤 Abgaben

- ✅ Screenshots von `ifconfig`/`docker inspect`
- ✅ Screenshots der `ping`-Tests
- ✅ Screenshots von `route`
- ✅ Analyse der Verbindungen und Netzwerkgrenzen
- ✅ Erklärung der Unterschiede (default bridge vs. benutzerdefiniert)
