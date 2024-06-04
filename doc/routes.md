# Routes


| IDENTIFIANT                        | ROLE MINI   | NOM                |
|------------------------------------|-------------|--------------------|
| /                                  |             |                    | 
| /connexion                         |             | app_login          |
| /deconnexion                       |             | app_logout         |
| /admin                             | USER        | app_admin          | 
| /admin/rapport                     | USER        | app_report_index   |
| /admin/rapport/{id}                | VETERINAIRE | app_report_show    |
| /admin/rapport/ajout               | VETERINAIRE | app_report_new     |
| /admin/rapport/{id}/edition        | VETERINAIRE | app_report_edit    |
| /admin/rapport/{id}                | VETERINAIRE | app_report_delete  |
| /admin/habitat                     | USER        | app_habitat_index  |
| /admin/habitat/{id}                | VETERINAIRE | app_habitat_show   |
| /admin/habitat/ajout               | ADMIN       | app_habitat_new    |
| /admin/habitat/{id}/edition        | ADMIN       | app_habitat_edit   |
| /admin/habitat/{id}                | ADMIN       | app_habitat_delete |
| /admin/animal                      | USER        | app_animal_index   |
| /admin/animal/{id}                 | ADMIN       | app_animal_show    |
| /admin/animal/{/ajout              | ADMIN       | app_animal_new     |
| /admin/animal/{id}/edition         | ADMIN       | app_animal_edit    |
| /admin/animal/{id}                 | ADMIN       | app_animal_delete  |
| /admin/avis                        | USER        | app_comment_index  |
| /admin/avis/{id}                   | EMPLOYE     | app_comment_show   |
| /admin/avis/ajout                  | EMPLOYE     | app_comment_new    |
| /admin/avis/{id}/edition           | EMPLOYE     | app_comment_edit   |
| /admin/avis/{id}                   | EMPLOYE     | app_comment_delete |
| /admin/service                     | USER        | app_service_index  |
| /admin/service/{id}                | EMPLOYE     | app_service_show   |
| /admin/service/ajout               | ADMIN       | app_service_new    |
| /admin/service/{id}/edition        | ADMIN       | app_service_edit   |
| /admin/service/{id}                | ADMIN       | app_service_delete |
| /admin/food                        | USER        | app_food_index     |
| /admin/food/{id}                   | USER        | app_food_show      |
| /admin/food/ajout                  | USER        | app_food_new       |
| /admin/food/{id}/edition           | USER        | app_food_edit      |
| /admin/food/{id}                   | USER        | app_food_delete    |
| /admin/image                       | USER        | app_image_index    |
| /admin/image/ajout                 | USER        | app_image_new      |
| /admin/image/{id}/edition          | USER        | app_image_edit     |
| /admin/image/{id}                  | USER        | app_image_delete   |
| /admin/utilisateur                 | ADMIN       | app_user_index     |
| /admin/utilisateur/{id}            | ADMIN       | app_user_show      |
| /admin/utilisateur/inscription     | ADMIN       | app_veto_register  |
| /admin/utilisateur/inscription/emp | ADMIN       | app_emp_register   |
| /admin/utilisateur/{id}/edition    | ADMIN       | app_user_edit      |
| /admin/utilisateur/{id}            | ADMIN       | app_user_delete    |
| /admin/verif/{token}               |             | verify_user        |
| /admin/renvoiverif                 |             | redend_verif       |
| /admin/utilisateur/{id}            | ADMIN       | app_user_delete    |
| /admin/breed                       | USER        | app_breed_index    |
| /admin/breed/{id}                  | USER        | app_breed_show     |
| /admin/breed/ajout                 | ADMIN       | app_breed_new      |
| /admin/breed/{id}/edition          | ADMIN       | app_breed_edit     |
| /admin/breed/{id}                  | ADMIN       | app_breed_delete   |