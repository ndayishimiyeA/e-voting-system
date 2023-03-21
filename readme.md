# E-Voting Application

This repository contains a secure and user-friendly E-Voting Application designed to streamline the voting process in various elections and referendums. The application aims to provide a convenient, transparent, and verifiable electronic voting experience to voters while preserving the integrity and security of the system.

## Current Features

1. This application offers one-time voting. Once the key is used to vote, the system will prohibit the access of the voting page.
2. This application encrypts the voting records to avoid direct data manipulation.
3. Real-time voting results. 
4. Printing of Results and Voting Passes.
5. User and Candidate Management
6. Real-time vote counting and result visualization
7. Verifiable and auditable voting records
8. Role-based access control for election administrators and monitors

## Server Requirements ##

PHP version 5.6 or newer is recommended.
It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

> I didn't really write those things. Uhmm. I copied that from the default Codeigniter's README. lol.

## Current Technologies Used

[MaterializeCSS](http://materializecss.com/)

[Codeigniter](http://codeigniter.com/)

[Ionic Framework](https://ionicframework.com/)

## Proposed Future Technologies stack
- Frontend: React, Redux, Material-UI, Axios
- Backend: Node.js, Express, JWT, Socket.io
- Database: PostgreSQL, Sequelize ORM
- Encryption: RSA, AES, Cryptographic Hashing
- Testing: Jest, Mocha, Chai, Enzyme
- CI/CD: GitHub Actions, Docker, Kubernetes

## Installation Notes ##

1. Extract the package to your `htdocs` or `www` directory (U NO SAY?). You can put this in another sub-directory. By default, this should be placed under `/e_voting/`, but if you wish to change it, reconfigure the `.htaccess`

2. Create and Import the database. Database is included in `/database/e_voting.sql`

3. By default, the database is named `e_voting`, if you wish to change it, reconfigure the database configuration file in `/application/config/database.php`. I bet you are intelligent enough what to change there.

4. To access the Administrator Panel, go to `http://localhost/voting_directory/sys/`. Use the default username: `admin` and password: `admin`

