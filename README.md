# e_bike
## Nepieciešamās programmas
* Docker Engine
* Docker CLI
* Docker Compose

windows lietotājiem: Docker Desktop on Windows
## Pirmo reizi palaižot projektu lokāli
### Izveidot ".env" failu projekta mapē
Nokopēt faila "example.env" saturu un ielīmēt jaunizveidotajā failā ".env"
### Izveidot ".env" failu web-backend mapē
Nokopēt faila "web-backend/example.env" saturu un ielīmēt to jaunizveidotajā failā "web-backend/.env"
### Atjaunināt composer failus
* cd web-backend
* composer update
### Izveidot ierakstus datubāzē
* cd web-backend
* docker-compose exec web-backend bash
* php artisan tinker
* Employee::factory()->count(20)->create()
* Ebike::factory()->count(20)->create()
* EmployeeEbike::factory()->count(8)->create()

## Palaist projektu lokāli
* service docker start
* docker-compose up
