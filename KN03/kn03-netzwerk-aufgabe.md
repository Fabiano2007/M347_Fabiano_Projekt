# KN03: Netzwerk, Sicherheit

## A) Eigenes Netzwerk (100%)

### IP-Adressen der Container

| Container | Netzwerk                | IP-Adresse |
| --------- | ----------------------- | ---------- |
| busybox1  | default (bridge)        | 172.17.0.2 |
| busybox2  | default (bridge)        | 172.17.0.3 |
| busybox3  | benutzerdefiniert (tbz) | 172.28.0.2 |
| busybox4  | benutzerdefiniert (tbz) | 172.28.0.3 |

---

### Ping-Ergebnisse

| Von ↔ Nach                         | Ergebnis       | Bemerkung                          |
| ---------------------------------- | -------------- | ---------------------------------- |
| busybox1 → busybox2 (172.17.0.3)   | Erfolgreich    | gleiches Netzwerk (default bridge) |
| busybox1 → busybox3 (172.28.0.2)   | Fehlgeschlagen | andere Netzwerke                   |
| busybox3 → busybox4 (Name oder IP) | Erfolgreich    | gleiches benutzerdef. Netzwerk     |
| busybox3 → busybox1 (172.17.0.2)   | Fehlgeschlagen | andere Netzwerke                   |

---

### Analyse

- Container im **gleichen Netzwerk** können sich erfolgreich per IP erreichen.
- Nur Container im **benutzerdefinierten Netzwerk** (tbz) können sich **auch per Name** ansprechen (DNS funktioniert).
- Container aus **unterschiedlichen Netzwerken** (default vs. tbz) können **nicht** miteinander kommunizieren.

---

### Befehlssammlung

**Netzwerk erstellen:**

```bash
docker network create --subnet=172.28.0.0/16 tbz
```

**Container starten:**

```bash
docker run -dit --name busybox1 busybox
docker run -dit --name busybox2 busybox
docker run -dit --name busybox3 --network tbz busybox
docker run -dit --name busybox4 --network tbz busybox
```

**IP herausfinden (alternativ zu grep):**

```bash
docker inspect busybox1
```

(und IP manuell in "IPAddress" im JSON suchen)

**Ping ausführen:**

```bash
docker exec -it busybox1 ping -c 2 172.17.0.3
docker exec -it busybox1 ping -c 2 172.28.0.2
docker exec -it busybox3 ping -c 2 busybox4
docker exec -it busybox3 ping -c 2 172.17.0.2
```

---

### Fazit bezogen auf KN02

- In KN02 waren alle Container im **selben Netzwerk**, daher war Kommunikation problemlos.
- In KN03 wurde bewusst zwischen default und benutzerdefiniertem Netzwerk unterschieden, um die Isolierung sichtbar zu machen.
- Dies dient der **Netzwerksicherheit** und der **gezielten Kommunikation** über docker networks.

