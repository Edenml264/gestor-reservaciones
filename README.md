# Gestor de Reservaciones

Sistema de gestión de reservaciones premium para servicios de lujo en Los Cabos, México. Esta plataforma permite a los usuarios reservar diversos servicios como chóferes, tours de golf, excursiones en yate y más, con una experiencia de usuario moderna y eficiente.

## Características

### Funcionalidades Principales
- Catálogo de servicios premium con imágenes y descripciones detalladas
- Sistema de reservaciones en tiempo real
- Panel de administración para gestión de servicios
- Sistema de notificaciones por email
- Gestión de disponibilidad y calendario
- Integración con pasarelas de pago (próximamente)

### Características Técnicas
- Framework Laravel 11.x con PHP 8.2+
- Livewire 3.x para componentes dinámicos
- Tailwind CSS para diseño responsivo
- Sistema de caché con Redis
- Base de datos MySQL optimizada
- API RESTful para integraciones (próximamente)

## Requisitos del Sistema

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- MySQL >= 8.0
- Redis (opcional, para caché)

## Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/Edenml264/gestor-reservaciones.git
cd gestor-reservaciones
```

2. Instalar dependencias de PHP:
```bash
composer install
```

3. Instalar dependencias de Node.js:
```bash
npm install
```

4. Configurar el archivo de entorno:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurar la base de datos en el archivo .env:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestor_reservaciones
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

6. Ejecutar las migraciones y seeders:
```bash
php artisan migrate --seed
```

7. Compilar assets:
```bash
npm run dev
```

8. Iniciar el servidor:
```bash
php artisan serve
```

## Configuración

### Email
Configurar las credenciales de email en el archivo .env:
```env
MAIL_MAILER=smtp
MAIL_HOST=tu_servidor_smtp
MAIL_PORT=587
MAIL_USERNAME=tu_usuario
MAIL_PASSWORD=tu_contraseña
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@tudominio.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Redis (Opcional)
Para habilitar el caché con Redis:
```env
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

## Optimizaciones Planificadas

### Rendimiento
- Implementación de caché para servicios frecuentemente accedidos
- Optimización de consultas de base de datos
- Lazy loading de imágenes
- Minificación de assets
- Implementación de PWA

### Seguridad
- Autenticación de dos factores
- Rate limiting para APIs
- Protección contra CSRF
- Validación avanzada de datos
- Encriptación de datos sensibles

### UX/UI
- Tema oscuro
- Animaciones y transiciones suaves
- Mejoras en la responsividad
- Reducción de tiempo de carga
- Interfaz adaptativa

### Escalabilidad
- Arquitectura de microservicios
- Sistema de colas para tareas pesadas
- Balanceo de carga
- Backups automatizados
- Monitoreo y logs

## Contribución

1. Fork el proyecto
2. Crear una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request

## Licencia

Este proyecto está bajo la licencia MIT. Ver el archivo `LICENSE` para más detalles.

## Soporte

Para soporte y consultas:
- Email: ventas@edenmendez.com
- Issues: https://github.com/Edenml264/gestor-reservaciones/issues

## Roadmap

Ver el archivo [TODO.md](TODO.md) para la lista completa de características planificadas y el estado actual del desarrollo.
