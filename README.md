## Instructions

create .env file with context of .env.example
put your Database Credintals in

``` 
DB_DATABASE=test
DB_USERNAME=root
DB_PASSWORD=
```
run 
```
 composer install
  ``` 

  run
   ```
 php artisan migrate 
  ``` 
  run
   ```
 php artisan db::seed 
  ``` 
## Usage

login as User using any email that generated from faker
``` 
password: password 
```
Here you can see User Referral Code , 
You can copy it to give it to any anouther user to register with it 
you can view users who registerd with you Referral Code 
you can view how many people visit your Referral Code Page! 

on any time you can go to {https://URL/logout } to logout! 
## Admin Panel 

login as Admin using:
``` 

email: admin@admin.com
password: password 
```

here you can see how many users that you have with count  of referred users

### Testing

``` 
php artisan test 
```

### Working On! 

-testing register 




## Credits

- [yazeed ayyash](https://github.com/yzedayyash)



