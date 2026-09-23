<h1 align="center">
    <br>
    <a href="https://easyappointments.org">
        <img src="https://raw.githubusercontent.com/alextselegidis/easyappointments/develop/logo.png" alt="Easy!Appointments" width="150">
    </a>
    <br>
    Easy!Appointments
    <br>
</h1>


## 🛠️ Fork Customizations (`giammaweb`)

This version is a fork maintained by **Gian Marco Artioli**, based on release **v1.6.0**. 
It includes specific adaptations for local infrastructure management and custom integration.

### Change Log & Guide for Future Releases

To reapply these customizations on a future Easy!Appointments release, refer to the official commits:

1. **Environment Parameters Centralization & `.gitignore`**
   - **Description:** Separation of environment credentials (`params.env`) and protection of cache and session files.
   - **Commit:** [`ce909d8`](https://github.com/giammaweb/easyappointments/commit/ce909d8)

2. **Dynamic Base URL Handling in Messages**
   - **Description:** Introduced the `BASE_URL_PLACEHOLDER` shortcode to load dynamic assets (e.g., images in suspension messages) directly from the environment URL.
   - **Commit:** [`35241d8`](https://github.com/giammaweb/easyappointments/commit/35241d8)

3. **Added a Personalized Theme for Accessibility**
   - **Description:** Added the `accesiblecolors.css` theme. Based on the corporate color set in the back office, it configures secondary colors to ensure higher contrast, aligning with WCAG accessibility guidelines.
   - **Commit:** [`b5069a8`](https://github.com/giammaweb/easyappointments/commit/b5069a8)

4. **Hided the povider selection when only one is available**
   - **Description:** Changed the behaviour of the AJAX functions in the booking.js file (updateConfirmFrame and $selectService.on(“change”, (event))). Before update text in the header and display input select, the system count the available options and decide if display the providers or not.
   PLEASE REMEMBER TO GENERATE AGAIN booking.min.js after change the file
   - **Commit:** [`dee9062`](https://github.com/giammaweb/easyappointments/commit/dee9062)


---

### Custom Theme Compilation via Terminal

#### 1. Requirement

Install the **Dart Sass** compiler (or `sassc`) on your system:

```bash
sudo apt update && sudo apt install sassc

```

*(Alternatively, if Node.js is installed: `sudo npm install -g sass`)*

---

#### 2. Compilation Commands

When modifying the source file `assets/css/themes/accesiblecolors.scss`, run the following commands from the project root:

```bash
# 1. Navigate to the themes directory
cd assets/css/themes/

# 2. Compile readable CSS version
sassc accesiblecolors.scss accesiblecolors.css

# 3. Compile minified CSS version for production
sassc -t compressed accesiblecolors.scss accesiblecolors.min.css

```



> **Note for the `sass` (npm) variant:**
> If you are using the npm `sass` package, the syntax for minification is:
> `sass accesiblecolors.scss accesiblecolors.min.css --style=compressed`

#### 3. Development Watch Mode (Optional)

If you are actively working on the file and want automatic recompilation on save:

```bash
sass --watch assets/css/themes/accesiblecolors.scss:assets/css/themes/accesiblecolors.css

```

---

> ⚠️ **WARNING — Native SCSS Files Management:**
> The vanilla `.scss` theme files in `assets/css/themes/` (e.g., `litera.scss`, `sketchy.scss`) rely directly on Bootstrap's SCSS source files, typically located in `node_modules`.
> 
> Since Easy!Appointments release zip packages do not include the `node_modules` directory (avoiding Node/npm dependencies), compiling native `.scss` files directly will trigger resource or missing variable errors (e.g., `$font-size-sm`).
> 
> **Recommended Workflow::**
> - Do not compile default `.scss` files without first installing the full development toolchain (`npm install`).
> - For custom themes (e.g., `accesiblecolors`), edit the base compiled CSS file (`.css`) by appending custom rules at the end, then regenerate the `.min.css` version via `cp` or `sassc`.

---

### Custom JS Minification via Terminal

#### 1. Requirement

Install the **terser** minifier on your system:

```bash
sudo apt update && sudo apt install terser

```

Go to the folder that contain the js file to minify, remove the previous minified version and execute this command:

```bash
terser nome_file.js -o nome_file.min.js -c -m

```
after file creation, remember to give the correct permissions



# The Next Paragraphs are a copy of the original documentation of the Easy!Appointments project


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
