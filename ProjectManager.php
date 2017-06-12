<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en" ng-app="ProjectManagerApp">
<head>
	<meta charset="UTF-8">
	<title>Project Manager</title>
  <script>document.write('<base href="' + document.location + '" />');</script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="libs/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="libs/fullcalendar-3.3.1/fullcalendar.min.css">
  <link rel="stylesheet" type="text/css" href="libs/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css">
  <link rel="stylesheet" type="text/css" href="css/test.css">

  <script src="libs/jquery/dist/jquery.js"></script>
  <script src="libs/moment/min/moment.min.js"></script>
  <script src="libs/fullcalendar-3.3.1/fullcalendar.js"></script>
  <script src="libs/angular/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0rc1/angular-route.min.js"></script>
  <script src="libs/bootstrap/dist/js/bootstrap.js"></script>
  <script src="libs/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js"></script>
  <script src="js/project_manager.js"></script>

</head>
<body>
	<div class="container-fluid" ng-controller="DbController">
		<div class="row">
			<div class="col-lg-2 col-mg-2 col-sm-2 hidden-xs block-left">
				<div class="userPhoto">
					<img src="images/1.jpg" alt="projectManager" class="img-responsive img-circle">
				</div>
				<div class="links">
					<ul class="nav nav-pills nav-stacked" style="font-size: 8pt;">
            <li>
              <a href="#/MemberList" class="en hide" ng-click="updateMembers()"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
              MEMBERS </a>
              <a href="#/MemberList" class="ukr" ng-click="updateMembers()"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
              РОБІТНИКИ </a>
            </li>
            <hr>
            <li>
              <a href="#/MyProject" class="en hide" ng-click="updateProjects()"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 
              MY PROJECT </a>
              <a href="#/MyProject" class="ukr" ng-click="updateProjects()"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 
              МІЙ ПРОЕКТ </a>
            </li>
            <hr>
            <li>
              <a href="#/Models" class="en hide" ng-click="updateModels()"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> 
              MODELS </a>
              <a href="#/Models" class="ukr" ng-click="updateModels()"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> 
              МОДЕЛІ </a>
            </li>
            <li>
              <a href="#/AddNewModel" class="en hide" ng-click="updateModels_2()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
              ADD NEW MODEL </a>
              <a href="#/AddNewModel" class="ukr" ng-click="updateModels_2()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
              ДОДАТИ МОДЕЛЬ </a>
            </li>
            <hr>
            <li>
              <a href="#/Stages" class="en hide" ng-click="updateStages()"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> 
              STAGES </a>
              <a href="#/Stages" class="ukr" ng-click="updateStages()"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> 
              ЕТАПИ </a>
            </li>
            <li>
              <a href="#/AddNewStages" class="en hide" ng-click="updateStages_2()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
              ADD NEW STAGE </a>
              <a href="#/AddNewStages" class="ukr" ng-click="updateStages_2()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
              ДОДАТИ ЕТАП </a>
            </li>
            <hr>
            <li>
              <a href="#/AllTasks" class="en hide" ng-click="updateTasks()"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> 
              ALL TASKS </a>
              <a href="#/AllTasks" class="ukr" ng-click="updateTasks()"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> 
              ВСІ ЗАВДАННЯ </a>
            </li>
            <li>
              <a href="#/StagesTasks" class="en hide" ng-click="updateStagesTasks()"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> 
              STAGE'S TASKS </a>
              <a href="#/StagesTasks" class="ukr" ng-click="updateStagesTasks()"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> 
              ПОЕТАПНІ ЗАВДАННЯ </a>
            </li>
            <li>
              <a href="#/AddNewTask" class="en hide" ng-click="updateTasks_2()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
              ADD NEW TASK </a>
              <a href="#/AddNewTask" class="ukr" ng-click="updateTasks_2()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
              ДОДАТИ ЗАВДАННЯ </a>
            </li>
            <hr>
            <li>
              <a href="#/TaskCalendar" class="en hide" ng-click="updateTaskCalendar()"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
              TASK CALENDAR </a>
              <a href="#/TaskCalendar" class="ukr" ng-click="updateTaskCalendar()"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
              КАЛЕНДАР ЗАВДАНЬ </a>
            </li>
            <hr>
            <li>
              <a href="#/MakeReport" class="en hide" ng-click="updateTaskReport()"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> 
              MAKE REPORT </a>
              <a href="#/MakeReport" class="ukr" ng-click="updateTaskReport()"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> 
              ЗВІТ </a>
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
        <nav ng-include src="'templates/navigationMenuProjectManager.html'"></nav>
				<!-- Navigation_end -->

				<!-- Main_start -->
				<div class="main-container">

          <div ng-include src="'templates/updateProjectModel.html'"></div>

          <div ng-include src="'templates/updateTask.html'"></div> 

          <div ng-include src="'templates/updateMyModel.html'"></div>  

          <div ng-include src="'templates/updateMyStage.html'"></div>

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