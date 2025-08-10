# SQL Injection Prevention Using AES Encryption

---

## 🔐 Introduction

With the rise of online shopping, especially due to the COVID-19 pandemic, millions shifted to digital platforms to order clothes, groceries, and more without physical contact. However, this surge in online activity has also increased security threats, particularly SQL injection attacks targeting backend databases.

Our project addresses these threats by implementing **AES (Advanced Encryption Standard)** encryption within MVC application controllers, enhancing data security for e-commerce websites and making user transactions strongly secure.

---

## 🛠️ Project Description

AES encryption is a globally recognized symmetric block cipher algorithm known for its robustness. By integrating AES encryption into sensitive data handling processes (such as login credentials), this project safeguards databases from SQL injection and unauthorized access.

Key features include:

- Encrypting usernames and passwords before storing in the database
- Limiting login attempts to prevent brute force and query structure probing
- Ensuring encrypted data is correctly decrypted on authorized pages

---

## 🔑 AES Algorithm Overview

AES (Rijndael algorithm) is a symmetric block cipher with a fixed block size of 128 bits and variable key lengths:

- **Block Size:** 128 bits (16 bytes)  
- **Key Lengths & Rounds:**  
  - 128-bit key → 10 rounds  
  - 192-bit key → 12 rounds  
  - 256-bit key → 14 rounds  

Key features of AES:

1. **Substitution-Permutation (SP) Network:**  
   Operates on an SP network rather than a Feistel structure like DES.  

2. **Key Expansion:**  
   A single key is expanded into multiple round keys for enhanced security.

3. **Byte-Oriented Processing:**  
   Encryption processes data in bytes instead of bits, making it efficient for modern computing.

---

## 🧩 Methodology

Our project prevents SQL injection attacks by:

- Encrypting vulnerable user information (usernames and passwords) before database storage using AES encryption.
- Enforcing a login attempt limit (3 tries), locking the user out after the 4th failed attempt to block malicious probing.
- Validating all data and requests rigorously to safeguard server information.
- Decrypting user information only for authorized sessions, e.g., displaying the username on the welcome dashboard.

This approach creates a secure login portal mimicking real-world login systems but with stronger defense mechanisms.

---

## 💻 Technologies Used

| Layer         | Technology                    |
| ------------- | -----------------------------|
| Backend       | Core PHP, MySQL               |
| Frontend      | HTML, CSS, JavaScript         |
| Development   | Visual Studio Code (IDE)      |

---

## 🎯 Features & Screenshots

- Encrypted storage of user credentials preventing SQL injection  
- Login attempt restrictions to avoid brute force and query structure attacks  
- Decrypted username display on dashboard for authenticated users  

*Example Output:*  
![Encrypted Data Screenshot](path-to-your-screenshot.png)  
*(Replace with your actual screenshot showing encrypted data)*

---

## 🚀 How to Run

1. Clone this repository  
2. Import the MySQL database and tables  
3. Configure database connection in PHP files  
4. Run the project on a local server (e.g., XAMPP, WAMP)  
5. Open the login portal in your browser and test encryption and login functionality  

---

## 🤝 Contribution

Feel free to fork this project and submit pull requests. Issues and feedback are always welcome!

---

## 📫 Contact

**Muhammad Absar Khalid**  
Email: mabsarkhalid@gmail.com
GitHub: [absar55](https://github.com/absar55)

---

*Stay safe, stay secure!*
