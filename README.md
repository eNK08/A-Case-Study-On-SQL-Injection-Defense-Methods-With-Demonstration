# A Case Study and Demonstration of SQL Injection Vulnerabilities

**By [Nikoloz Kurtanidze](https://github.com/eNK08) and [James McGrath](https://github.com/JMcGrath2025)**  

---

## Overview

This project presents a technical case study and practical demonstration of SQL Injection (SQLi) vulnerabilities and defense techniques. It includes two sample web applications:

- A vulnerable version, illustrating typical insecure coding practices.
- A secure version, rewritten using proper validation and secure query practices.

All simulations are strictly educational.

---

## Paper

The full paper can be found in the `/paper` directory:
- `Nikoloz Kurtanidze & James McGrath - Secure Coding Term Project.pdf`

---

## Demonstration

Located in the `/demo` folder:

### Vulnerable DB

This folder contains an intentionally vulnerable banking-style web portal. It is used to demonstrate how unsanitized inputs can lead to SQL injection.

**Files:**
- `admin.php` – Vulnerable admin panel using insecure GET requests
- `bankdemo.sql` – MySQL database dump with test users
- `login.html` – Frontend login form
- `login.php` – Login logic vulnerable to SQLi
- `search.php` – Search functionality with injectable query
- `style.css` – Basic UI styling

### Secure DB

This folder contains a rewritten version of the same application with secure coding practices, such as input validation, prepared statements, and access control.

**Files:**
- `admin.php`
- `bankdemo.sql`
- `login.html`
- `login.php`
- `search.php`
- `style.css`

---

## Environment

- Stack: PHP 7/8, MySQL
- Local server: XAMPP, MAMP, WAMP, or equivalent
- No frameworks or real credentials used

---

## Disclaimer

These applications are intentionally insecure and are meant for lab-only, offline educational use.  
Do not deploy these on public-facing servers.

---

## Authors

| Name               | Role                       | GitHub                                           |
| ------------------ | -------------------------- | ------------------------------------------------ |
| Nikoloz Kurtanidze | Research, Writing | [@eNK08](https://github.com/eNK08)               |
| James McGrath      | Research, Development, Writing    | [@JMcGrath2025](https://github.com/JMcGrath2025) |

---

## License

This project is licensed under the MIT License. See `LICENSE` for details.

---

