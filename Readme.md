# Docker-Umgebung

## Inhaltsverzeichnis
- [Voraussetzungen](#voraussetzungen)
- [Installation von Docker auf Windows](#installation-von-docker-auf-windows)
- [Projektverzeichnis anlegen](#projektverzeichnis-anlegen)
- [Docker Compose verwenden](#docker-compose-verwenden)
- [Nützliche Docker-Befehle](#nützliche-docker-befehle)

## Voraussetzungen
- Windows 10 oder höher
- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- Git (optional, falls Repository verwendet wird)

## Installation von Docker auf Windows
### 1. Docker Desktop herunterladen
- Gehe zur [Docker Desktop Website](https://www.docker.com/products/docker-desktop) und lade die **Docker Desktop für Windows** Version herunter.

### 2. Docker Desktop installieren
- Führe die heruntergeladene `.exe`-Datei aus und folge den Installationsanweisungen.
- Stelle sicher, dass die Option "Use WSL 2 instead of Hyper-V" aktiviert ist (WSL 2 ist leistungsfähiger und empfohlen).

### 3. Docker Desktop starten
- Nach der Installation öffne Docker Desktop und starte es. Du solltest eine Benachrichtigung sehen, dass Docker erfolgreich läuft.

### 4. Überprüfen der Installation
- Öffne ein Terminal (Powershell oder Eingabeaufforderung) und führe den folgenden Befehl aus, um zu überprüfen, ob Docker korrekt installiert wurde:

    ```bash
    docker --version
    ```

    Die Ausgabe sollte die installierte Docker-Version anzeigen.

## Projektverzeichnis anlegen
### 1. Erstelle ein Projektverzeichnis
- Erstelle ein Verzeichnis für dein Projekt:

    ```bash
    mkdir mein-docker-projekt
    cd mein-docker-projekt
    ```

### 2. Kopiere alle Dateien aus diesem Verzeichnis in dein Projektverzeichnis:

### 3. Konfiguriere den Container:
- im File `docker-compose.yaml` sind alle Einstallungen zu finden (z.B. für die Ports)
- im File `.env` sind die Datenbank Einstellungen zu finden (Username, Password,...)
- im File `Dockerfile` sind die Einstellungen für den Webserver (Apache, PHP Version,...)
  
das `.env` File muss - falls noch nicht vorhanden - manuell hinzugefügt werden:
```bash
MYSQL_VERSION=9.5
MYSQL_ROOT_PASSWORD=htlkrems
MYSQL_DATABASE=test_db
MYSQL_USER=devuser
MYSQL_PASSWORD=devpass
# interne Docker Registry:
DOCKER_REGISTRY_URL=192.168.0.246:5000/ 
# externe Docker Registry (Eintrag bleibt leer!):
#DOCKER_REGISTRY_URL= 
```
Im .env File ist die schulinterne Docker-Registry eingetragen, dh. dass die Container von intern gepullt werden. Falls Sie die Container vom offiziellen DockerHub beziehen wollen muss das im `.env` File geändert werden 

**Um die Container aus der interen Registry pullen zu können muss in den Einstellungen folgendes hinzugefügt werden:**
```json
{
  "insecure-registries": [
    "192.168.0.246:5000"
  ]
}
```

## Docker Compose verwenden
### 1. Docker Compose Build ausführen
- Um das Docker-Image zu erstellen, führe den folgenden Befehl im Projektverzeichnis aus:

    ```bash
    docker compose build
    ```

### 2. Container starten
- Nachdem das Build abgeschlossen ist, starte den Container mit:

    ```bash
    docker compose up
    ```

*(Falls Docker beim Starten nach einer Freigabe auf der eigenen Festplatte fragt, diese mit JA beantworten. Dann kann es sein dass Docker mit einem Fehler beendet wird. Das kann sein dass das 2x passiert, beim 3. Mal läuft er)*

- Der Container sollte nun laufen, und du kannst die Anwendung über `http://localhost:9999` in deinem Browser aufrufen.
- phpMyAdmin ist über `http://localhost:9998` erreichbar.

### 3. Container im Hintergrund (optional)
- Um den Container im Hintergrund auszuführen, verwende:

    ```bash
    docker-compose up -d
    ```

## Nützliche Docker-Befehle
- **Container stoppen**:

    ```bash
    docker-compose down
    ```

- **Container und Volumes entfernen**:

    ```bash
    docker-compose down --volumes
    ```

- **Logs anzeigen**:

    ```bash
    docker-compose logs
    ```

- **Neu bauen** (nach Änderungen am `Dockerfile` oder der Anwendung):

    ```bash
    docker-compose up --build
    ```

## Weiterführende Links
- [Docker Compose Documentation](https://docs.docker.com/compose/)
- [Dockerfile Best Practices](https://docs.docker.com/develop/develop-images/dockerfile_best-practices/)

