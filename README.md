# XKCD

This project is a PHP-based email verification system where users register using their email, receive a verification code, and subscribe to get a random XKCD comic every day. A CRON job fetches a random XKCD comic and sends it to all registered users every 24 hours.

---

✅ Implemented all required functions in `functions.php`.

✅ Implemented a form in `index.php` to take email input and verify via code.

✅ Implemented a CRON job to send XKCD comics to registered users every 24 hours.

✅ Implemented an unsubscribe feature where users can opt out via email verification.

✅ Implemented `unsubscribe.php` to handle email unsubscription.

---

You can use [Mailpit](https://mailpit.axllent.org/) for local testing of email functionality.

Installation guide for windows :

Step 1: Download Mailpit

1. Go to the GitHub releases page:
👉 https://github.com/axllent/mailpit/releases


2. Download the Windows executable:

mailpit-windows-amd64.exe
or mailpit-windows-arm64.exe as recommended 

---

Step 2: Move to C:\Program Files\Mailpit

1. Create a folder:

C:\Program Files\Mailpit


2. Move the downloaded .exe file into that folder.

mailpit.exe


---
Step 3: Add to System PATH

1. Open System Properties > Environment Variables.


2. Under System Variables, find and edit Path.


3. Add:

C:\Program Files\Mailpit


---

Step 4: Configure SMTP in php.ini

Use these local development SMTP settings:

SMTP Server: localhost
SMTP Port: 1025

---

Step 5: Run mailpit 

Now you can just type mailpit from terminal window then Open the shown link (http://localhost:8025) on your browser and visit. 


**Recommended PHP version: 8.3**

---

## 📌 Features Implemented

### 1️⃣ **Email Verification**
- Users enter their email in a form.
- A **6-digit numeric code** is generated and emailed to them.
- Users enter the code in the form to verify and register.
- Store the verified email in `registered_emails.txt`.

### 2️⃣ **Unsubscribe Mechanism**
- Emails should include an **unsubscribe link**.
- Clicking it will take user to the unsubscribe page.
- Users enter their email in a form.
- A **6-digit numeric code** is generated and emailed to them.
- Users enter the code to confirm unsubscription.

### 3️⃣ **XKCD Comic Subscription**
- Every 24 hours, cron job should:
  - Fetch data from `https://xkcd.com/[randomComicID]/info.0.json`.
  - Format it as **HTML (not JSON)**.
  - Send it via email to all registered users.

---
## 🔄 CRON Job Implementation

📌 You must implement a **CRON job** that runs `cron.php` every 24 hours.



