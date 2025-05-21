Additional maps are stored in the repository neveldo/mapael-maps

Full link: https://github.com/neveldo/mapael-maps



#1 ADMINS_ROLES TABLE MODIFIED 20/05/2025

-- Delete the foreign key if it exits
ALTER TABLE admins_roles DROP FOREIGN KEY admins_roles_admin_id_foreign;

-- change the column name and the type. 
ALTER TABLE admins_roles CHANGE admin_id subadmin_id INT;