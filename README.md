# gimmick-forum
A web forum with gimmick boards, written in PHP, inspired by a discord server I am on. It was written as a final project for my programming class in 2024. Due to requirements of said project, I don't use a proper database, but save all my data in .txt files.
## features
 - log in a register system
 - a system for posting messages
 - a system for banning user from a board
 - a system for tracking overall visits, as well as tracking visits per board and per user
 - systems for administrators to manage pages
 - a report system
 - an account customization system
 - an upvote system

 - theme switching system
 - user statistics
## install instructions
This program is written in PHP without the use of external libraries, so just clone the repo and you should be OK. Keep in mind, that the program uses multibyte strings, so check if your distro ships the support of multiline strings with its PHP packages (on debian installing `php-mbstring` is required), and the program features a system for sending forgotten passwords, which requires a configured email agent, like `sendmail`.
## TODO list
- ~~Make statistics table change color in dark mode~~
- ~~Fix bug with deleting posts~~
- Fix bug with downvotes

![image](https://github.com/lasermtv07/gimmick-forum/assets/118477750/dd7cbc98-b384-4c15-8ac0-8f837dfbf2aa)

---

(c) lasermtv07, 2024
