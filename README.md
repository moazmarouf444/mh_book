# cross team dashboard 
dashboard works with InterFace/Repository Design Pattern , read more about design pattern [here](https://asperbrothers.com/blog/implement-repository-pattern-in-laravel)
## Usage 
create empty dataBase , change database data in .env file 
first run commands 

```bash
composer update
```
```bash
php artisan migrate --seed
```
to migrate base tables of dashboard and create new users , roles and permissions to use dashboard 
email    : aait@info.com
password : 123456

## Usage for create new section in dashboard

```bash
php artisan make:fullsection SectionName arabicSingleName arabicPluralName 
```
## tips 
- SectionName It must be singular, not plural, and begins with the capital letter 
- arabicSingleName The name of the section in Arabic singular
- arabicPluralName The name of the section in Arabic plural
- this command create for you meny files (Controller in Admin Folder , Model in Models folder , DataBase Migrate , Blade Folder in admin folder And Blade File , basic [index - store - update - delete] routes in web.php file for dashboard use )
- you can use ( --seed ) optional with command to create new Seeder for this section 
- you can use ( --ob ) optional with command to create new Observer for this section 
- you can use ( --request ) optional with command to create new form request file and folder in Request/Admin  for this section 
- you can use ( --resource ) optional with command to create new resource for this section in Resources/Api Folder



## Example
- for create new section for banks in dashboard run command  
```bash 
php artisan make:fullsection Bank بنوك بنك --seed --ob --request --resource 
```
--- command create new files to use 

- new Controller (BankController.php) with 4 main functions (index - store - update - delete ) 

- new model (Bank.php) with its database migration

- new folder (banks) in resources/Admin folder and new blade file (index.blade.php) in this folder contains base structer of file edit it as you need 

- new seeder file (BanksTableSeeder) if you use (--seed) with command 

- new observer file (BankObserver) if you use (--ob) with command 

- new form Request folder (Banks) and request File (Store.php) in Requests/Admin

- new Resource for Api use in Resources/APi

-  new [show - store - update -delete ] routes in web.php to use in dashboard 



## Usage for create section without dashboard section


```bash
php artisan make:semisection SectionName 
```
## tips 
- SectionName It must be singular, not plural, and begins with the capital letter 
- this command create for you meny files (New Repository , Interface , Model in Models folder , DataBase Migrate)
- you can use ( --seed ) optional with command to create new Seeder for this section 
- you can use ( --ob ) optional with command to create new Observer for this section 
- you can use ( --resource ) optional with command to create new resource for this section in Resources/Api Folder



## Example
- for create new section for banks in dashboard run command  
```bash 
php artisan make:semisection Bank  --seed --ob --request --resource 
```
--- command create new files to use 

-- new model (Bank.php) with its database migration

-- new seeder file (BanksTableSeeder) if you use (--seed) with command 

-- new observer file (BankObserver) if you use (--ob) with command 

-- new Resource for Api use in Resources/APi


## Dashboard components 

read more about laravel 8 components [here](https://laravel.com/docs/8.x/blade#components)
- (x-admin.breadcrumb) 

## Dashboard scripts

- The following file contains a set of functions that facilitate working with graphs (admin/charts_functions.js)

## home page cards 

- all home page cards included in (app/traits/menu) file 

## home page weather widget 

-  You can control the country, colors, size, number of days and type of icons from the following link and copy your code and replace it on the home page [here](https://weatherwidget.io/) 

## publish
https://documenter.getpostman.com/view/14274509/UVeNniR5


*** شرح التطبيق  *** 
* تطبيق لطباعه الاوراق والصور يمكن المستخدم من التسجيل واضافه ملفات وصور واختيار انواع الملفات والصور واختيار حجم الطباعه a3 او a4 زاخنيار نوع الطباعه عادي او الوان واختيار الغلاف واختيار اطار (اختياربي )
* واختيار نوع الدفع اون لاين او عند الوصول 