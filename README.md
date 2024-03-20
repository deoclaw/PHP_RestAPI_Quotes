# Quotes DB Project
This is a quotes restful API created for a midterm project using PHP and PostgreSQL

## Challenges
Part of the challenge was set up (I should have just logged into Windows, I do not know why I bother using Linux), part was knowledge gaps, and part was just passing automated tests. Below are the challenges I ran into. 

### Set-Up Hell
I am using Ubuntu (the stripped down install) LTS on a VM on a pop!_os install. So you see my first mistake was thinking Linux would be easier. I followed the [Installing and Using PostgreSQL Locally article from CodeAcademy](https://www.codecademy.com/article/installing-and-using-postgresql-locally). Installation of postgresql was fine except I had no idea how to get into it. Installed Postbird, went fine. Was lost at what to do next after running Postbird. In trying to log in to Postbird, the default password did not work. Postgres documentation was unhelpful. Found a gist on github that didn't get me where I needed. Finally [found a way](https://discuss.codecademy.com/t/setting-up-postgresql-ubuntu-linux-cannot-connect-dont-know-password/635248) to change the default postgres password to be able to log in: 
1. ```sudo su - postgres``` to change to the user postgres
2. ```psql```
3. ```\password``` to change the user `postgres` to have a new password.

Another [solution](https://discuss.codecademy.com/t/postbird-cant-connect/609229) seemed to involve creating your own user based on the username of the machine but the above worked for me so I left it alone. I wish I understood why the postgres user is...also a superuser?

In creating the database, Postbird was a bit glitchy and required running a query to [alter the database](https://stackoverflow.com/questions/68895862/how-to-add-foreign-key-in-postgresql). If something is going to have a GUI I'd hope it would be less glitchy or hidden than it is. Honestly, I'm not totally sure what the point of using Postbird is since I'm going to have to run commands to populate these quotes *any* way. There's not really a point to a GUI for this (unless the alternative is so much worse, which, I guess it is as psql seems insanely obtuse.) 

### Stopping PostgreSQL
Not easy to understand how to start/stop this when I'm not using it. Found instructions on [stackoverflow](https://stackoverflow.com/a/49828382) to use ```systemctl stop postgresql``` and ```systemctl start postgresql``` respectively (view status with ```systemctl status postgresql```)

### My Quotes Didn't Work Until They Did
Making my quotes show for authors and categories kept failing. Stepping through it still kept producing JSON errors. Eventually I just removed any var_dumps or echos and it suddenly worked. I am not sure what happened. Additionally, I feel like a lot of code was reused but at this point, it works so it's staying. I'm sure I can abstract out into a function later.

(This later did not happen but after lurking the discord, the advice to make an `isValid()` function to help validated data simplified a lot.)

### I should have started with the live DB
I created my database locally thinking I could easily export and import via Postbird and Render. Mistake! While there is a command ```pg_dump``` it basically necessitated I switch my user to ```postgres```, run ```psql```, run ```pg_dump quotesdb > quotesdb.sql``` and then run ```chmod 777``` on the file and then ```sudo mv``` the file to somewhere I could more easily access it. Even after that, I had to essentially retype the commands because everything wanted to ```COPY from STDIN``` which was not cooperating! I know I've been spoiled by a GUI for everything but this felt like overkill.

### Passing the Automated Tests Was Painful
I feel like there was a huge gap between what we trained on and then what we had to attempt. I also feel like there's got to be a more efficient way to have gone about the code I wrote. I could clear the general requirements but still failed many of the automated tests and much of the headaches was trying to parse what was trying to be passed. I feel like my code is a mess because I had to go back and try to shoehorn in solutions for the tests. Eventually it resulted in practically re-writing chunks. I recognize that part of the problem is I'm now working backwards to solve for these tests. Ultimately it worked but the road to get there was maddening. Additionally, I struggled to submit the results as my adblocker was blocking the submission. 