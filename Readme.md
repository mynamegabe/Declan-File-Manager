# __Declan File Manager__ :briefcase:
## Used to be an Application Security Project but now just a cool side project
### SQL Server:
> root@localhost\
> 

### Features
#### 1. User login
#### 2. User registration
#### 3. File viewing
#### 4. File upload
#### 5. Folders
#### 6. File deletion
#### 7. File favourites
#### 8. File sharing

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
