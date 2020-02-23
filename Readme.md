# Assignment 2 Writeup

For the web application provided, I tested for the following known vulnerabilities that were mentioned in the description of the [assignment](PROG38263-Assignment2-Winter2020.pdf)

## Cross-Site Scripting (XSS)

- **Identification:** For finding where XSS vulnerability could be exploited I explored the platform to where user could input data and found text areas in the editing article webpage aka Title and article text.

- **Execution:** After identifying potential text areas, I inserted simple script tags with alert message popups in those text areas and was successful in exploiting them. I have attached the documented proof below.

![Screen recording for an XSS attack](images/basicxssalertattack.gif)

- **Impact:** Although I managed to exploit a simple case of popping up an alert box, however, attackers could leverage XSS to launch attacks such as account hijacking to steal the session cookies and thus fully compromise the website. I could also steal credentials by cloning the login page of the web application and then using the XSS vulnerability in order to serve it to the victims.

- **Mitigation:** One of the security control measures that can be employed to mitigate XSS attack is to encode all fields when displaying them in the browser. Additionally, ensure that text is properly filtered or sanitized or use a third-party plugin like an HTML purifier or also use the function `htmlspecialchars()`.

## SQL Injection

- **Identification:** To know if the website could be exploited with sql injection, i tried to identify webpages which projected data from database and tried passing incorrect data as parameters. Through which and without proper logs on website i found out the database used and some information about query handing.

- **Execution:** For the execution on the above identified page, I ran _sqlmap_ tool to check for any potential injection attacks and the tool gave there cases. I selected a case and tried to find table names and column name and then passed on a sql injection attacked which would give user login details and we could find admin user login credentials.

![Screen recording for sql injection getting admin password](images/sqlinjectionpasswordattack.gif)

- **Impact:** High impact, in real life this succesful attack will comprise the whole website and server.

- **Mitigation:** To mitigating most of sql injection attacks i used prepared statements and parameterized queries. An advanced option is to use external driver tools like PDO (data objects) to achieve immunity from sql injection attacks, below is an example of mysql prepare statement in php.

```php
    $stmt = $dbConnection->prepare('SELECT * FROM employees WHERE name = ?');Security Control
```

## Missing role-based access control enforcement and management

- **Identification:** It was evident that the access control was broken when i logged in with student user.

- **Execution:** The student could access the functionalities like modifying and deleting every article on website once logged in rather than only the posts which were created by him.

![Screen recording for student user having access to admin page](images/accessrolesissue.gif)

- **Impact:** Giving user more control than needed will cause choas in the application, now with giving normal user access to admin pages if user was a bad actor could go ahead and clean the webiste and insert malicious scripts on all the webpages which could steal other users login details and execute other attacks.

- **Mitigation:** To mitigate this vunerability there is need to implement role-based access properly. On this code base, i added role of user in the session and hardcoded a crosscheck on every page, as a usecase but in realworld more complex systems can be implemnted.

## Broken Access Control

- **Identification:** For finding this

- **Execution:**

![Screen recording for deleting article without login](images/deletearticlewithoutlogin.gif)

- **Impact:**

- **Mitigation:** Security Control

## Insecure password handling and storage

- **Identification:** For finding this

- **Execution:**

- **Impact:**

- **Mitigation:** Security Control

## CSRF

- **Identification:** For finding this

- **Execution:**

- **Impact:**

-**Mitigation:** Security Control

## No security certificate (https)

- **Identification:** For finding this

- **Execution:**

![Screen capture login page](images/httplogin.png)

- **Impact:**

- **Mitigation:** Security Control

## Only default logs

- **Identification:** For finding this

- **Execution:**

![Screen capture for default logs in bash](images/logscmdngnix1.png)

![Screen capture for default logs in browser](images/logscmdngnix2.png)

- **Impact:**

- **Mitigation:** Security Control
