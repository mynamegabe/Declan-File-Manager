# __Declan File Manager__ :briefcase:
## Used to be an Application Security Project but now just a cool side project
### SQL Server:
> root@localhost
> l3tsg01337

### Features
#### 1. User login [x]
#### 2. User registration [x]
#### 3. File viewing [x]
#### 4. File upload [x]
#### 5. Folders [x]
#### 6. File deletion [x]
#### 7. File favourites [ ]
#### 8. File sharing [ ]
#### 9. Storage limitation [ ]
#### 10. Clean UI(Open to feedback) 


### Security Features
#### 1. SQL Injection Prevention :syringe:
- Login

#### 2. Session/Cookie Encryption :cookie:
- Prevents easy change of cookie for session hijacking

#### 3. XSS Mitigation
- File sharing comments

#### 4. XXE Prevention
- Document loading

#### 5. Arbitary File Upload Prevention(File MIME check)
- File upload

#### 6. Local File Inclusion/Traversal Prevention
- File viewing

#### 7. Sensitive Data Exposure
- Password manager and credit card details for purchase of more storage

#### 8. Access Control
- Roles for shared folders

#### 9. Logging
- File access logs
