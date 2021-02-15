# Project 10 - Fortress Globitek

Time spent: **4** hours spent in total

> Objective: Create an intentionally vulnerable version of the Globitek application with a secret that can be stolen.

### Requirements

- [x] All source code and assets necessary for running app
- [x] `/globitek.sql` containing all required SQL, including the `secrets` table
- [x] GIF Walkthrough of compromise
- [x] Brief writeup about the vulnerabilities introduced below

### Vulnerabilities

This project currently has a vulnerability in the source code. There is a hidden html tag which contains
information which can allow a user to access a hidden page that should only be accessbile to an admin. There
is also an xss vulenerability in the index.php within the salespeople directory. The  project will later include an
xss vulenerabilty which will provide the user with greater access to the website. 

Currently the vulnerability in the source code allows a user to access a page where they can directly upload sql
syntax to the database. Later on an xss vulnerability will be added on and this will shift more of the attack focus 
on to the xss. 

### Video

<img src='http://imgur.com/b10BXWX.gif' title='Video Walkthrough' width='' alt='Video Walkthrough' />
