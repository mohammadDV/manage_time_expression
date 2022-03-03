## Manage time expression service

In this system I wrote a service for display remain time between two date with time expression and
I used “Chain of Responsibility” and implement this Design pattern with one interface and one abstract class and some class I needed form calculating time such as Month , Day , …
also I used one trait for calculating repetitive function of classes.

for executing this service it's enough you do these:
-	Command to run migration “php artisan serve”
-	Command to run test “php artisan test”

## Docker image
- https://hub.docker.com/r/mohammaddv/manage_time_expression
- docker pull mohammaddv/manage_time_expression

## Design pattern:
- Chain of Responsibility

## Project’s files:
1.	TimeHandlerService.php 		in “app/Services/TimeHandler/”.
2.	HandleExpression.php		in “app/services/TimeHandler/Traits”
3.	TimeHandler.php                             	in “app/Services/TimeHandler/Interfaces/”.
4.	AbstractTimeHandler.php	    	in “app/Services/TimeHandler/Classes/”.
5.	MonthHandler.php			in “app/Services/TimeHandler/Classes/”
6.	DayHandler.php			in “app/Services/TimeHandler/Classes/”
7.	HourHandler.php			in “app/Services/TimeHandler/Classes/”
8.	MinuteHandler.php			in “app/Services/TimeHandler/Classes/”
9.	SecondHandler.php			in “app/Services/TimeHandler/Classes/”
10.	IndexController.php			in “app/Http/Controller/Api/”
11.	DateRequest.php			in “app/Http/Requests/”
12.	ExpressionRule			in “app/Rules/”
13.	api.php				in “routes/”
14.	TimeHandlingTest.php		in “tests/Unit/”


## Routes:
- Link	http::/Your_domain.com/api
- Description	Show time expressions
- Method	POST
- p : date1	= 2020-03-01T12:30:00 type = date
- p : date2	= 2020-01-01T00:00:00 type = date
- p : exp	= 2m,m,h,i,3i type = string
- Sample Response	[
  "2m = 1",
  "m = 0",
  "h = 12",
  "3i = 10",
  "i = 0"
  ] 

