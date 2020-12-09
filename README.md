# attendance_php
A web-application designed for taking attendance by directly connecting to a database.
NOTE : The following tables with appropriate column names are required if you want to start right away;
  CREATE TABLE students (
    Roll INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(128),
    English VARCHAR(64),
    Maths VARCHAR(64),
    Science VARCHAR(64),
    Social VARCHAR(64)
    )
    
  CREATE TABLE ips (
    IP VARCHAR(512),
    Request VARCHAR(32),
    Post VARCHAR (32)
    )
    
  CREATE TABLE passwords (
    subject VARCHAR(128),
    pass VARCHAR(512)
    )
    
Insert data in "students" and "passwords" before using the application.
