<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en" ng-app="ProjectManagerApp">
<head>
	<meta charset="UTF-8">
  <title class="en hide">Employee</title><title class="ukr">Робітник</title>
  <script>document.write('<base href="' + document.location + '" />');</script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="libs/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/test.css">
  <link rel="stylesheet" type="text/css" href="libs/fullcalendar-3.3.1/fullcalendar.css">

  <script src="libs/jquery/dist/jquery.min.js"></script>
  <script src="libs/moment/min/moment.min.js"></script>
  <script src="libs/fullcalendar-3.3.1/fullcalendar.js"></script>
  <script src="libs/angular/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0rc1/angular-route.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="js/employee.js"></script>

</head>
<body>
	<div class="container-fluid" ng-controller="DbController">
		<div class="row">
			<div class="col-lg-2 col-mg-2 col-sm-2 hidden-xs block-left">
				<div class="userPhoto">
					<img src="images/1.jpg" alt="projectManager" class="img-responsive img-circle">
				</div>
				<div class="links">
					<ul class="nav nav-pills nav-stacked">
            <li>
              <a href="#/MyProject" class="en hide" ng-click="updateMyProject()"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 
              MY PROJECT </a>
              <a href="#/MyProject" class="ukr" ng-click="updateMyProject()"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 
              МІЙ ПРОЕКТ </a>
            </li>
            <hr>
            <li>
              <a href="#/AllTasks" class="en hide" ng-click="updateAllTasks()"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> 
              ALL TASKS </a>
              <a href="#/AllTasks" class="ukr" ng-click="updateAllTasks()"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> 
              ВСІ ЗАВДАННЯ </a>
            </li>
            <li>
              <a href="#/MyTasks" class="en hide" ng-click="updateMyTasks()"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> 
              MY TASKS </a>
              <a href="#/MyTasks" class="ukr" ng-click="updateMyTasks()"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> 
              МОЇ ЗАВДАННЯ </a>
            </li>
            <hr>
            <li>
              <a href="#/MyTaskCalendar" class="en hide" ng-click="updateTaskCalendar()"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
              TASK CALENDAR </a>
              <a href="#/TaskCalendar" class="ukr" ng-click="updateTaskCalendar()"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
              КАЛЕНДАР ЗАВДАНЬ </a>
            </li>
            <hr>
            <li>
              <a href="" class="en hide" ng-click="chooseLang()"><span class="glyphicon glyphicon-random" aria-hidden="true"></span> 
              CHOOSE LANG</a>
              <a href="" class="ukr" ng-click="chooseLang()"><span class="glyphicon glyphicon-random" aria-hidden="true"></span> 
              ВИБІР МОВИ</a> 
            </li>
					</ul>
				</div>
			</div>
			
			<div class="col-lg-10 col-mg-10 col-sm-10 col-xs-12 block-right">
				
				<!-- Navigation_start -->
        <nav ng-include src="'templates/navigationMenuEmployee.html'"></nav>
				<!-- Navigation_end -->

				<!-- Main_start -->
				<div class="main-container">

          <div ng-include src="'templates/updateMyTask.html'"></div>   

          <ng-view></ng-view>
        
			  </div>
				<!-- Main_end -->

			</div>
		</div>
	</div>

<!-- LOG_OUT -->
<div ng-include src="'templates/logOut.html'"></div>

</body>
</html>