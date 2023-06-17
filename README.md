# SIMASI (Sistem Manajemen Pengungsi)

The creation of a refugee management system in collaboration with the Regional Disaster Management Agency (BPBD) of Batu City, East Java, was based on an urgent need to increase the efficiency and effectiveness of handling refugees in situations of natural disasters or emergencies.

![image](https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/2bd4ea5d-df64-4fbe-af87-01ef0548987a)

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
  <img src="" width="800" />
  <img src="" width="800" />
  <img src="" width="800" />
  <img src="" width="800" />
  <img src="" width="800" />
  <img src="" width="800" />

- The dashboard display contains summary information from several features such as total chickens, total culling chickens, total dead chickens to total chickens ready for harvest. In addition, there is also information on the cumulative feed until the vaccination period

  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/540c81c4-1114-46a7-80b1-8098e3ae94bf" width="800" />

### 3. Stable Management

- The manage chickens feature is used to collect data related to incoming chicken from suppliers. In this feature, the admin can also make changes and delete data

  *Cage data display*

  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/1e9c4b02-d549-4419-8330-84b733307956" width="800" />

  *Display adds cage data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/1c76456c-0abf-4b83-9ebf-3e73c88ca043" width="800" />

  *Display updates cage data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/29312250-661a-4500-a216-e1dc187ab7ab" width="800" />

  *Display deletes cage data*

  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/3fe1279f-140f-494c-8d63-dc757d88da94" width="800" />

### 4. Inspection

- The inspection feature is carried out to collect data on chickens every day by controlling the number of culling and dead chickens and controlling the average weight of chickens and the portion of chicken feed

  *Inspection data display*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/ed41fb91-98c0-41ee-ad42-f01b945049cb" width="800" />
  
  *Display adds inspection data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/87bb030b-53a0-4aca-b37f-e1517c0359d7" width="800" />
  
  *Display updates inspection data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/a8607806-e909-495a-8cc1-758f251cfc67" width="800" />
  
  *Display deletes inspection data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/eb85a7eb-95b4-4444-a114-16543eca63ed" width="800" />
  
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
