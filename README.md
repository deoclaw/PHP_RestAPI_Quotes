# Quotes DB Project
This is a quotes restful API created for a midterm project using PHP and PostgreSQL

# Difficulties
Herein I air the many grievances I have suffered.

## Set-Up Hell
I am using Ubuntu (the stripped down install) LTS on a VM on a pop!_os install. So you see my first mistake was thinking Linux would be easier. I followed the [Installing and Using PostgreSQL Locally article from CodeAcademy](https://www.codecademy.com/article/installing-and-using-postgresql-locally). Installation of postgresql was fine except I had no idea how to get into it. Installed Postbird, went fine. Was lost at what to do next after running Postbird. In trying to log in to Postbird, the default password did not work. Postgres documentation unhelpful. Found a gist on github that didn't get me where I needed. Finally [found a way](https://discuss.codecademy.com/t/setting-up-postgresql-ubuntu-linux-cannot-connect-dont-know-password/635248) to change the default postgres password to be able to log in: 
1. ```sudo su - postgres``` to change to the user postgres
2. ```psql```
3. ```\password``` to change the user `postgres` to have a new password.

Another [solution](https://discuss.codecademy.com/t/postbird-cant-connect/609229) seemed to involve creating your own user based on the username of the machine but the above worked for me so I left it alone.
