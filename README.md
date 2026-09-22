<h1 align="center">
    <br>
    <a href="https://easyappointments.org">
        <img src="https://raw.githubusercontent.com/alextselegidis/easyappointments/develop/logo.png" alt="Easy!Appointments" width="150">
    </a>
    <br>
    Easy!Appointments
    <br>
</h1>


---

## 🛠️ Personalizzazioni Fork (`giammaweb`)

Questa versione è un fork gestito da **Gian Marco Artioli** basato sulla release **v1.6.0**. 
Include adattamenti specifici per la gestione dell'infrastruttura locale e dell'integrazione personalizzata.

### Registro delle Modifiche & Guida per nuove Release

Per riapplicare queste modifiche su una release futura di Easy!Appointments, fare riferimento ai commit ufficiali:

1. **Centralizzazione Parametri d'Ambiente e `.gitignore`**
   - **Descrizione:** Separazione delle credenziali d'ambiente (`params.env`) e protezione dei file di cache e sessione.
   - **Commit:** [`ce909d8`](https://github.com/giammaweb/easyappointments/commit/ce909d8)

2. **Gestione Dinamica dell'URL Base nei Messaggi**
   - **Descrizione:** Introduzione dello shortcode `{BASE_URL}` per caricare gli asset dinamici (es. immagini nei messaggi di sospensione) direttamente dall'URL d'ambiente.
   - **File modificati:** `application/views/appointments/book.php` (o controller `Booking.php`)
   - **Commit:** [Incolla qui il link al tuo commit dello Step 2]


Hai perfettamente ragione. Se il backoffice di EasyAppointments legge direttamente i file presenti dentro `assets/css/themes/`, la scelta migliore per garantire un flusso di lavoro **pulito, lineare e indipendente da VS Code/IDE** è compilare da terminale tramite l'utility **Sass**.

In questo modo i file rimangono nella loro posizione naturale e la procedura può essere documentata per i tuoi colleghi in modo universale (funzionerà su Zorin OS, Ubuntu, macOS o qualsiasi server Linux).

---

### Procedura di Compilazione del Tema Custom via Terminale


#### 1. Requisito

Installare il compilatore **Dart Sass** (o `sassc`) sul sistema:

```bash
sudo apt update && sudo apt install sassc

```

*(In alternativa, se è già presente Node.js nel sistema: `sudo npm install -g sass`)*

---

#### 2. Comandi di Compilazione

Quando viene modificato il file sorgente `assets/css/themes/accesiblecolors.scss`, eseguire da terminale nella radice del progetto:

```bash
# 1. Posizionarsi nella cartella dei temi
cd assets/css/themes/

# 2. Compilare la versione CSS leggibile
sassc accesiblecolors.scss accesiblecolors.css

# 3. Compilare la versione minificata per la produzione
sassc -t compressed accesiblecolors.scss accesiblecolors.min.css

```



> **Nota per la variante `sass` (npm):**
> Se usi il pacchetto `sass` installato via npm, la sintassi per la minificazione è:
> `sass accesiblecolors.scss accesiblecolors.min.css --style=compressed`

#### 3. Modalità "Watch" per lo Sviluppo (Opzionale)

Se stai lavorando attivamente sul file e vuoi che ogni salvataggio compili automaticamente il tema senza dover rieseguire il comando a mano:

```bash
sass --watch assets/css/themes/accesiblecolors.scss:assets/css/themes/accesiblecolors.css

```

---

> ⚠️ **ATTENZIONE — Gestione file SCSS nativi:**
> I file `.scss` dei temi vanilla presenti in `assets/css/themes/` (es. `litera.scss`, `sketchy.scss`) dipendono direttamente dai sorgenti SCSS di Bootstrap, normalmente collocati nella cartella `node_modules`.
> 
> Poiché i pacchetti release/zip di EasyAppointments distribuiscono l'applicazione senza la cartella `node_modules` (evitando le dipendenze da Node/npm), la compilazione diretta dei file `.scss` nativi genera errori di risorse o variabili mancanti (es. `$font-size-sm`).
> 
> **Procedura raccomandata:**
> - Non compilare i file `.scss` di default senza aver prima installato la toolchain completa (`npm install`).
> - Per le personalizzazioni custom (es. `accesiblecolors`), lavorare sul file CSS compilato di base (`.css`) ed estenderlo in fondo, rigenerando poi la versione `.min.css` tramite `cp` o `sassc`.

---



<h4 align="center">
    A powerful, self-hosted appointment scheduling platform built for flexibility.
</h4>

<p align="center">
  <img alt="License" src="https://img.shields.io/github/license/alextselegidis/easyappointments?style=for-the-badge">
  <img alt="Latest Release" src="https://img.shields.io/github/v/release/alextselegidis/easyappointments?style=for-the-badge">
  <img alt="Downloads" src="https://img.shields.io/github/downloads/alextselegidis/easyappointments/total?style=for-the-badge">
  <a href="https://discord.com/invite/UeeSkaw">
    <img alt="Discord" src="https://img.shields.io/badge/chat-on%20discord-7289da?style=for-the-badge&logo=discord&logoColor=white">
  </a>
</p>

<p align="center">
  <a href="#why-easyappointments">Why Easy!Appointments</a> •
  <a href="#features">Features</a> •
  <a href="#quick-start">Quick Start</a> •
  <a href="#installation">Installation</a> •
  <a href="#license">License</a>
</p>

---

<p align="center">
  <strong>Looking for advanced capabilities?</strong><br>
  Explore premium features and professional services at
  <a href="https://easyappointments.org/premium" target="_blank">easyappointments.org/premium</a>.
</p>

---



## 🚀 Why Easy!Appointments

**Easy!Appointments** is an open-source scheduling system that gives you full control over your booking workflow.

It is designed to adapt to your business — whether you need simple appointment booking or more advanced scheduling logic.

**Key advantages:**

- Fully self-hosted — your data stays under your control
- Highly customizable and flexible
- Integrates with your existing website and database
- Free for both personal and commercial use

---

## ✨ Features

Built to support a wide range of scheduling needs:

- Appointment and customer management
- Service and provider organization
- Working plans and booking rules
- Google Calendar synchronization
- Email notification system
- Multi-language interface
- Self-hosted deployment
- Active open-source community

---

## ⚡ Quick Start (Development)

Clone and run the project locally using the provided Docker Compose environment:

```bash
# Clone the repository
git clone https://github.com/alextselegidis/easyappointments.git

# Navigate into the project
cd easyappointments

# Start the Docker environment
docker compose up
````

Then open a second terminal and enter the application container:

```bash id="app-shell"
docker compose exec app bash
```

Inside the container, install dependencies:

```bash id="deps"
npm install && composer install
```

Start the development watcher:

```bash id="dev"
npm start
```

Build production assets:

```bash id="build"
npm run build
```

> Note: Works on Windows (WSL recommended), macOS, and Linux using Docker Compose.

---

## 🏗️ Installation (Production)

### Requirements

* Apache or Nginx
* PHP 8.2+
* MySQL database

### Steps

1. Create a database (or use an existing one)
2. Upload the `easyappointments` folder to your server
3. Ensure the `storage` directory is writable
4. Rename `config-sample.php` to `config.php`
5. Update configuration values
6. Open the application in your browser and follow the setup wizard

Once completed, the system is ready to use.

---

## 📚 Resources

* Website: [https://easyappointments.org](https://easyappointments.org)
* Issues: [https://github.com/alextselegidis/easyappointments/issues](https://github.com/alextselegidis/easyappointments/issues)
* Support Group: [https://groups.google.com/forum/#!forum/easy-appointments](https://groups.google.com/forum/#!forum/easy-appointments)
* Discord: [https://discord.com/invite/UeeSkaw](https://discord.com/invite/UeeSkaw)

---

## 📜 License

* Code: GPL v3.0
* Content: CC BY 3.0

---

## 👤 Author

* Website: [https://alextselegidis.com](https://alextselegidis.com)
* GitHub: [https://github.com/alextselegidis](https://github.com/alextselegidis)
* Twitter: [https://twitter.com/AlexTselegidis](https://twitter.com/AlexTselegidis)

---

## 🔥 More Projects

* [Plainpad · Self-Hosted Note Taking](https://github.com/alextselegidis/plainpad)
* [Clientverse · CRM Application](https://github.com/alextselegidis/clientverse)
* [Timecrack · Time Tracking](https://github.com/alextselegidis/timecrack)
