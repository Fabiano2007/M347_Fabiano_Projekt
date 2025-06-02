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

![Screenshot 2025-05-26 150855](https://github.com/user-attachments/assets/564f91aa-2706-4c40-953d-fdb4feb93348)
![Screenshot 2025-05-26 150905](https://github.com/user-attachments/assets/163f08a8-5107-4a35-b4ee-a36e088b55f9)
![Screenshot 2025-05-26 150919](https://github.com/user-attachments/assets/5e592564-d3d2-483c-a75f-ac8fce068a35)
![Screenshot 2025-05-26 150927](https://github.com/user-attachments/assets/d9c23d55-3a9e-4480-bcb5-710963010852)
![Screenshot 2025-05-26 151247](https://github.com/user-attachments/assets/c355312a-2270-4ef2-8916-967916770659)
![Screenshot 2025-05-26 152214](https://github.com/user-attachments/assets/e133fb80-0df2-4194-a2a6-2a61c556d2bf)
![Screenshot 2025-05-26 160248](https://github.com/user-attachments/assets/58d470e5-7ce7-477f-b49b-bdd6569d89aa)

✅ Gemeinsamkeiten:
Container im gleichen Netzwerk haben:

gleichen Gateway

können sich per Name und IP erreichen

Standardmässig ist jede Bridge-Umgebung isoliert

❌ Unterschiede:
Container in verschiedenen Netzwerken:

können sich nicht pingen

DNS-Auflösung funktioniert nicht (z. B. ping busybox3 von busybox1)

Routing ist unterbunden (standardmässig)

