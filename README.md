# Description

Application de génération de reférencement naturel

## Environnement de développement

### Pré-requis
 
 * PHP 7.4
 * Composer
 * PSR-2
 
#### lancer l'environnement de développement
      
          composer install
          npm install
          npm run build
          php artisan serve
          php artisan migrate:install
          php artisan migrate:fresh --seed
          

#### Lancer les Tests

```bash  
        php artisan test
  ```

#### Initialise JWT

```bash  
        php artisan jwt:secret
  ```

##### STATUS CODE DESCRIPTION

```bash  
        200 : ok
        201 : Created
        202 : Accepted
        202 : Non-Authoritative Information
        400 : Bad Request
        401 : Unauthorized
        402 : Payment Required
        403 : Forbidden
        404 : Not Found
  ```
