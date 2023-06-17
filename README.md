# SIMASI (Sistem Manajemen Pengungsi)

The creation of a refugee management system in collaboration with the Regional Disaster Management Agency (BPBD) of Batu City, East Java, was based on an urgent need to increase the efficiency and effectiveness of handling refugees in situations of natural disasters or emergencies.

![image](https://github.com/rizqi-ardiansyah/SimasiApp/assets/86498942/733a7f5e-6c65-4976-a51b-83424d2d2b12)

# Feature

### 1. Login

- Login can be done by the admin or the employee. Admins can access all features, while employees only have a few features

  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/2bd4ea5d-df64-4fbe-af87-01ef0548987a" width="800" />

  *Default admin account*
  ```sh
    Email: pusdalop1@gmail.com
    Password: password
    ```
  *Default employee account*
  ```sh
    Email: trc1@gmail.com
    Password: password
    ```
### 2. Dashboard

- The dashboard display contains several important information such as the total admin, total employees, total disasters, to the chart of refugees

  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/b95bf3e5-75f7-4390-a0de-136fa94d8059" width="800" />
  
### 3. Disaster Management

- Disaster management is used to manage disasters that occur in the area and find out about disasters that have occurred

  *Disaster data display*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/35228a2c-11c4-4bf6-a4a4-4469cddc4580" width="800" />

  *Display adds disaster data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/3436b177-2fb3-49a4-8616-818a9bd6ed7e" width="800" />

  *Display updates disaster data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/9939a739-6c28-4e5e-b86d-0c9981e55f2c" width="800" />

  *Display deletes disaster data*

  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/f86771bc-98ac-4c94-a2fd-27384b0a1225" width="800" />

### 4. Post Management

- Post management is a feature that can be used when a disaster is about to happen and has been. This feature is used to manage posts used for refugees. This feature also provides the remaining capacity in the post

  *Post data display*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/6ed5f3e9-20de-4000-87a1-6b0ac84fad84" width="800" />
  
  *Display adds post data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/6554ce2e-019f-4954-838a-dc0d9017d63b" width="800" />
  
  *Display updates post data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/c91f3416-012c-4f9e-9360-46eaaf0431a4" width="800" />
  
  *Display deletes inspection data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/a40fbd3b-e5d9-48d1-b1c9-b97bd766fc11" width="800" />
  
### 4. Vaccination

- The function of the vaccination feature is to manage the chicken vaccination process which is equipped with a scheduling feature. So that it can help employees to remember the vaccine schedule in the future

  *Vaccination data display*

  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/803a25f2-518c-418d-a3db-c5eebe1b224f" width="800" />
  
  *Display adds inspection data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/f479465b-7dc4-41a5-9382-d8c67a63e44c" width="800" />

  *Display updates inspection data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/cb4c0d21-018b-4476-9cbb-17a2f49b25ea" width="800" />

  *Display deletes inspection data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/702efaa3-62cd-4bdf-8f80-c020a275b9e5" width="800" />

### 5. Report

- The report feature will assist employees in accumulating the data that has been obtained and can be printed in excel and pdf format

  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/c326c418-520c-4c90-87f9-da5b6d256ef5" width="800" />

# Installation

1. Clone the repository
   
2. Install composer
    ```bash
    composer install
    ```
    
3. Copy file .env.example
     ```bash
    cp .env.example .env
    ```
     
5. Generate the key
    ```bash
    php artisan key:generate
    ```

8. Do the migrations first
    ```sh
    php artisan:migrate
    ```

9. Do the seeder first
    ```sh
    php artisan:seeder
    ```
    
10. Run projects
    ```sh
    php artisan serve
    ```
    
# License

The MIT License (MIT) 2023 - [Rizqi Ardiansyah](https://github.com/rizqi-ardian/). Please have a look at the [LICENSE.md](LICENSE.md) for more details.
