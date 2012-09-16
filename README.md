MySQL
===
Databases:
---

---

db = divecatalina

---

db = dev

---

Users:
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

usr = dev @ localhost

pz = 

privileges = all on divecatalina, all on dev

// this is our development account (for local development)
