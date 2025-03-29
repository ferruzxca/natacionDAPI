# 🏊 Sistema Web - Centro de Natación Innovex

Este proyecto es un sistema web completo desarrollado en **PHP**, **MySQL** y **HTML/CSS** para la gestión de un centro de natación. Permite administrar clases, horarios, promociones, usuarios y competencias acuáticas desde diferentes niveles de acceso: **Administrador**, **Vendedor** y **Cliente**.

---

## 🎯 Funcionalidades

### 🔐 Acceso con Roles
- Inicio de sesión seguro con sesiones y cookies.
- Tres tipos de usuarios:
  - **Administrador**: control total del sistema.
  - **Vendedor**: puede gestionar usuarios de natación y competencias.
  - **Cliente**: vista pública informativa.

---

### 👤 Panel del Administrador
- Gestión completa de **usuarios** (altas, bajas, edición, estados).
- CRUD de **horarios**, **promociones**, **reglamento**, **instalaciones**, **competencias**, **rehabilitación**.
- Generación de **reportes en PDF** con FPDF.
- Visualización de **gráficas mensuales** con Chart.js.

---

### 🧑‍💼 Panel del Vendedor
- Registro de **nuevos nadadores**.
- Consulta de **horarios**.
- Crear **nuevas promociones**.
- Ver y crear **competencias acuáticas**.
- Consulta del **reglamento**.

---

### 🌐 Vista Pública para Clientes
- Galería de **instalaciones con imágenes**.
- Promociones activas.
- Horarios, reglamento y requisitos.
- Calendario de competencias.

---

## 🧰 Tecnologías Utilizadas

- **PHP 7+**
- **MySQL / MariaDB**
- **HTML5 / CSS3**
- **JavaScript (Chart.js)**
- **FPDF** para generación de PDF
- **Visual Studio Code** para desarrollo

---

## 🗂️ Estructura de Carpetas

📁 centro-natacion/ ├── admin/ # Panel del Administrador │ ├── dashboard.php │ ├── gestionar_usuarios.php │ ├── gestionar_horarios.php │ ├── gestionar_promociones.php │ ├── gestionar_reglamento.php │ ├── gestionar_instalaciones.php │ ├── gestionar_competencias.php │ ├── gestionar_rehabilitacion.php │ └── (archivos adicionales para editar/eliminar registros) │ ├── vendedor/ # Panel del Vendedor │ ├── dashboard.php │ ├── agregar_usuario_natacion.php │ ├── crear_promocion.php │ ├── crear_competencia.php │ ├── ver_horarios.php │ ├── ver_reglamento.php │ └── ver_competencias.php │ ├── cliente/ # Vista informativa del Cliente │ └── index.php │ ├── auth/ # Login y Logout │ ├── login.php │ ├── validar_login.php │ └── logout.php │ ├── database/ # Conexión a la base de datos │ └── conexion.php │ ├── includes/ # Navbar y recursos comunes │ └── navbar.php │ ├── reports/ # Reportes en PDF y gráficas │ ├── reporte_pdf.php │ └── grafica_mes.php │ ├── assets/ # Recursos estáticos (CSS, imágenes) │ ├── estilos.css │ └── img/ │ ├── alberca.jpg │ ├── gimnasio.jpg │ └── rehabilitacion.jpg │ ├── fpdf/ # Librería FPDF para PDFs │ └── fpdf.php │ └── index.php # Página inicial del sitio

---

## 📌 Usuarios de Prueba

| Rol          | Usuario      | Contraseña   |
|--------------|--------------|--------------|
| Administrador| `admin`      | `admin123`   |
| Vendedor     | `vendedor1`  | `vende123`   |
| Cliente      | `cliente1`   | `cliente123` |

> Las contraseñas están encriptadas usando `SHA-256`.

---

## 🚀 Instalación

1. Clona el repositorio en tu entorno local:
   ```bash
   git clone https://github.com/ferruzxca/natacionDAPI.git
   
2. Crea una base de datos MySQL llamada natacion_db.
3. Importa el script SQL con todas las tablas y registros iniciales (solicitar si aún no se ha generado).
4. Configura tu archivo de conexión:
    database/conexion.php
5. Ejecuta el sistema en tu servidor local (XAMPP, MAMP, etc.) o súbelo a un hosting compatible con PHP y MySQL.

## 👨‍💻 Autor

Raúl Ferruzca
Desarrollado como parte del proyecto escolar DAPI - Desarrollo de Aplicaciones para Internet.

## 📃 Licencia

MIT – Este proyecto es libre de usar, modificar y distribuir con fines educativos o comerciales.
