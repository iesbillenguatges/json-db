# Administració bàsica d'usuaris en PHP (CRUD + JSON)

Aquest projecte implementa una **administració bàsica d’usuaris (CRUD)** utilitzant **PHP pur** i un **fitxer JSON** com a sistema d’emmagatzematge, sense necessitat de base de dades.

És ideal per a **pràctiques**, **prototips** o **projectes petits**.

---

## 📁 Estructura del projecte

```
/
├── admin_usuaris.php
└── usuaris.json
```

---

## ⚙️ Requisits

- PHP 7.4 o superior
- Servidor web (Apache, Nginx, servidor integrat de PHP)
- Permisos d’escriptura sobre el fitxer `usuaris.json`

---

## 🚀 Instal·lació i execució

1. Copia els fitxers al directori del servidor web
2. Crea el fitxer `usuaris.json` amb el contingut inicial següent:

```json
[]
```

3. Assegura’t que el servidor pot escriure el fitxer:
```bash
chmod 666 usuaris.json
```

4. Accedeix des del navegador:
```
http://localhost/admin_usuaris.php
```

---

## ✨ Funcionalitats

- ➕ **Alta d’usuaris**
- 👁 **Consulta i llistat**
- ✏️ **Modificació**
- 🗑 **Baixa**
- Persistència mitjançant **JSON**
- Interfície web senzilla integrada en un únic fitxer PHP

---

## 🧩 Camps d’usuari

| Camp       | Descripció              |
|------------|-------------------------|
| nom        | Nom complet de l’usuari |
| email      | Correu electrònic       |
| data_alta  | Data d’alta (YYYY-MM-DD)|

---

## 🛠 Funcionament intern

- Les dades es llegeixen des de `usuaris.json`
- Cada usuari es desa com un objecte dins d’un array
- L’índex de l’array s’utilitza com a identificador
- El fitxer es reescriu completament després de cada operació

---

## 🔒 Limitacions

- No inclou autenticació ni control d’accés
- No és apte per entorns amb concurrència elevada
- No valida duplicats d’e-mail
- No utilitza base de dades relacional

---

## 📈 Millores possibles

- Autenticació d’administrador
- Validació avançada de camps
- Prevenció d’edicions concurrents
- Separació MVC
- Conversió a API REST
- Migració a base de dades (MySQL, SQLite, etc.)

---

## 📜 Llicència

Projecte lliure per a ús educatiu i personal.

---

## 👤 Autor

Creat com a exemple d’administració CRUD en PHP amb persistència en JSON.
