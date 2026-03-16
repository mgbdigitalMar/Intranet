# 🏢 IntraNet — Portal Corporativo Laravel

Portal de intranet corporativa con panel de administración visual. **Cualquier persona puede gestionar empleados, reservas, noticias y solicitudes sin tocar código ni base de datos.**

---

## ⚡ Instalación en 5 pasos

### Requisitos previos
- PHP 8.1 o superior
- Composer
- MySQL o MariaDB (o SQLite para pruebas)
- Node.js (opcional, para assets)

### 1. Descargar e instalar Laravel
```bash
# En la carpeta donde quieres el proyecto:
composer create-project laravel/laravel intranet
cd intranet
```

### 2. Copiar los archivos de este proyecto
Copia todos los archivos de esta carpeta dentro del proyecto Laravel, **reemplazando** los existentes.

### 3. Configurar la base de datos
Edita el archivo `.env` (está en la raíz del proyecto Laravel):
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=intranet_empresa
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

> 💡 **Para pruebas rápidas con SQLite** (sin instalar MySQL):
> Cambia `DB_CONNECTION=sqlite` y crea un archivo vacío en `database/database.sqlite`

### 4. Ejecutar la instalación automática
```bash
php artisan key:generate
php artisan migrate --seed
```

Esto crea todas las tablas y carga datos de ejemplo automáticamente.

### 5. Arrancar el servidor
```bash
php artisan serve
```

Abre el navegador en: **http://localhost:8000**

---

## 🔑 Cuentas de acceso (datos de ejemplo)

| Rol | Email | Contraseña |
|-----|-------|-----------|
| **Administrador** | admin@empresa.com | admin123 |
| Empleado | ana@empresa.com | emp123 |
| Empleado | luis@empresa.com | emp123 |
| Empleado | marta@empresa.com | emp123 |

---

## 🛠️ Cómo gestionar los datos (sin código)

### Desde el panel de Administración (dentro del portal):
- Ve a **⚙️ Panel Admin** en el menú lateral
- Puedes **añadir, editar y eliminar** empleados, noticias, y gestionar todas las solicitudes
- **No necesitas acceder a la base de datos en ningún momento**

### Cambiar el nombre de la empresa:
Edita el archivo `.env` y añade esta línea:
```
APP_NAME="Nombre de tu empresa"
```

### Cambiar el logo/icono:
En `resources/views/layouts/app.blade.php`, busca el texto `🏢` y cámbialo.

---

## 📋 Funcionalidades incluidas

- ✅ **Login/Logout** con roles (Admin y Empleado)
- ✅ **Dashboard** con estadísticas y alertas automáticas
- ✅ **Alertas de cumpleaños** (el día anterior y el mismo día)
- ✅ **Alertas de eventos** (el día anterior)
- ✅ **Alertas de ausencias** de compañeros
- ✅ **Noticias y Eventos** (crear, editar, eliminar)
- ✅ **Reservas de salas** con disponibilidad en tiempo real
- ✅ **Reservas de vehículos** con estado de flota
- ✅ **Solicitudes de compra** con flujo de aprobación
- ✅ **Ausencias** con aprobación del administrador
- ✅ **Directorio de empleados** con cumpleaños
- ✅ **Panel de administración** completo (solo admins)
- ✅ Todos los datos se guardan en la **base de datos MySQL**
- ✅ **Responsive** (funciona en móvil y tablet)

---

## ❓ Preguntas frecuentes

**¿Cómo añado un nuevo empleado?**
Accede con una cuenta de administrador → Panel Admin → Empleados → "Añadir empleado"

**¿Cómo apruebo una solicitud de compra?**
Panel Admin → Solicitudes de compra → Botón ✅ "Aprobar"

**¿Puedo añadir más salas o vehículos?**
Panel Admin → Configuración → Salas/Vehículos

**¿Cómo hago un empleado administrador?**
Panel Admin → Empleados → Editar → Cambiar rol a "Administrador"

**¿Dónde están los datos?**
En la base de datos MySQL que configuraste. Nunca necesitas acceder directamente.
