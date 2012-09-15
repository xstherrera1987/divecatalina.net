MySQL
=
Databases:
-
---
db = divecatalina

---

db = dev

---
Users:
-
---

usr = root @ ...

pz = (anything you like)

privileges = all

// this is the default mysql root account, leave as is

---

usr = divecatalina @ localhost

pz = 

privileges = all on divecatalina

// this is the account wordpress uses (during development)

---


---
usr = dev @ localhost

pz = 

privileges = all on divecatalina, all on dev

// this is our development account (for local development)

---

WordPress
=
usr = admin

pz = teamgrep

// this is development login to wordpress

---

usr = webmaster

pz = divecatalina

// this is wordpress account for uploading content

---

WordPress Install 
-
(http://localhost/wp-admin/install.php)

Site Title = DiveCatalina

Username = admin

password = teamgrep

youremail = webmaster@divecatalina.net

