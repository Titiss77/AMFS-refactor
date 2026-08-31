# Palmes en Cornouailles & AllBigProjects Platform

A comprehensive web application suite built with **CodeIgniter 4 (PHP)**, designed for club management, performance tracking, membership automation, and media curation.

---

## 🚀 Overview

This repository contains full-stack web applications and tools developed around community management and sports performance tracking (specifically tailored for finswimming/natation and media tracking).

### Core Projects Included:
1. **Palmes en Cornouailles Website (`cmg-navy.22web.org` / `pec-intranap.is-best.net`)**: Official website and member intranet for the Quimper finswimming club, featuring automated re-enrollments, performance sync with external platforms (Strava, Intervals.icu, COROS), blacklist management, and administrative dashboards.
2. **Titiss Space (`titiss.space`)**: A modular portfolio and media/expense tracking management web app (`AMFS`), featuring custom metadata scraping, Glassmorphism UI, advanced user roles, audit logging, and automated deployment via GitHub Actions.

---

## 🛠️ Tech Stack & Architecture

- **Backend**: PHP 8.x, CodeIgniter 4 Framework (`MVC` architecture)
- **Database**: MySQL / MariaDB (Migrations & Seeds configured)
- **Frontend**: Modern HTML5, CSS3 (Glassmorphism & custom styling), JavaScript, Tailwind / Custom CSS
- **Automation & Tools**: Node.js, Python (`coros_sync.py` with `yt-dlp` & `ffmpeg`), Tesseract OCR for workout image parsing, Composer, Docker, GitHub Actions CI/CD.
- **Security**: Bitwarden, AdGuard DNS, CSRF protection, robust authentication and authorization layers.

---

## 📁 Project Structure

```text
AllBigProjects-main/
├── cmg-navy.22web.org/          # Club website & member portal (CodeIgniter 4)
├── pec-intranap.is-best.net/    # Intranet, performance tracking & sync modules
├── titiss.space/                # Personal platform, AMFS app, audit logs & admin panel
├── sites_non_lances/            # Staging and upcoming projects
└── .github/workflows/           # CI/CD deployment pipelines (FTP/GitHub Actions)
```

---

## ⚙️ Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/AllBigProjects.git
   cd AllBigProjects
   ```

2. **Configure Environment:**
   Copy `.env_default` to `.env` in the respective project directories and update your database credentials:
   ```env
   database.default.hostname = localhost
   database.default.database = your_database
   database.default.username = your_username
   database.default.password = your_password
   database.default.DBDriver = MySQLi
   ```

3. **Install Dependencies:**
   ```bash
   composer install
   ```

4. **Run Database Migrations:**
   ```bash
   php spark migrate
   php spark db:seed
   ```

5. **Start Development Server:**
   ```bash
   php spark serve
   ```

---

## 📈 Key Features

- **Club Management & Memberships**: Automated user registration, validation, and role-based access control.
- **Performance Analytics**: Sync athletic workouts, monitor heart rate thresholds, and process training metrics.
- **Media Tracking (AMFS)**: Custom metadata management, status tracking, and reactive UI.
- **Automated Deployments**: Integrated GitHub Actions workflows for seamless staging and production updates.

---

## 📄 License

This project is open-source and available under the [MIT License](titiss.space/htdocs/LICENSE).
