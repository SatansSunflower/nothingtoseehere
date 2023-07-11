# Tutorial

## New Model 

1. Strg + N
2. Add Table 
3. [Change Name and add all columns](./img/create_table_wb.png)
4. create all needed tables
5. go to "add diagram"

## Diagrams

1. [create diagram](./img/create_diagram_wb.png)
2. use the connectors to make references (Foreign Keys)
3. make sure everything is done and considered
4. TAKE A PICTURE FOR DOCUMENTATION!

## Forward Engineering

1. when the diagram is finished go to: Database -> Forward Engineer OR **Strg + G**
2. pick the connection you have established before
3. go next until the "Review SQL Script" part where you need to copy the SQL Script and then cancel
4. paste the script into a new query and **REMOVE THE "VISIBLE" part!**

NOTE: the VISIBLE keyword is used for newer versions and not supported for the older version.

5. paste the SQL script into your documentation 
6. execute the query
7. go to phpmyadmin and check if it has been created (maybe you need to refresh it)
8. you can write your inserts in PHPmyAdmin or in MySQLWorkbench, but if you do it in phpmyadmin you need to make sure you copy the INSERT statements then and paste them into your documentation!

NOTE: The columns all have checkboxes which all have a meaning and usage, which you can find in [this summary](https://www.tutorialspoint.com/what-do-column-flags-mean-in-mysql-workbench).