#  Todo List project 

## Introduction

The purpose is to create a small Todo List project which is composed of:
- A Web server displaying a simple webpage where you can display and add a Todo
- A database where the Todos are saved
- Tests for each step of the software

## Files

Web page: todolist.php associated with style.css
Database: todo_list.sql where we have the Todos
Tests: - testFunctions.php composed of all test functions 
	   - testSessionStart.php from which we run the tests

## Run Instructions

If you import sql file in MySQL as well, you should put the whole folder in www directory.
To connect to the database, here are what I used:
- server name: "localhost"
- user name: "root"
- password: ""
Warning: Usually, on windows the password is "" whereas on Mac it is "root" !

What you have to run to check the todo list ?
--> You have to tape `http://localhost/todolist.php` on your localhost

What you have to run to check the test session ?
--> You have to tape `http://localhost/testSessionStart.php` on your localhost


## Programming languages

I worked on: 
- HTML, CSS for the web page, 
- PHP to connect the web page to the database and to do the tests, 
- and finally MySQL to save the Todos.

## Bibliography/webography

To create my project, I used those sources:
- https://codewithawa.com/posts/to-do-list-application-using-php-and-mysql-database
- https://developer.mozilla.org/fr/docs/Web/HTML/Element/thead

## Author

Vithusha Sivakumaran
ING4 SI Group 1 (International Section)
