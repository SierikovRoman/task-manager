<!DOCTYPE html>
<html lang="en" ng-app="AdministratorApp">
<head>
	<meta charset="UTF-8">
	<title>Administrator</title>
  <script>document.write('<base href="' + document.location + '" />');</script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" type="text/css" href="app/libs/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="app/libs/fullcalendar-3.3.1/fullcalendar.min.css">
  <link rel="stylesheet" type="text/css" href="app/libs/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css">
  <link rel="stylesheet" type="text/css" href="app/css/test.css">

  <script src="app/libs/jquery/dist/jquery.js"></script>
  <script src="app/libs/moment/min/moment.min.js"></script>
  <script src="app/libs/fullcalendar-3.3.1/fullcalendar.js"></script>
  <script src="app/libs/angular/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0rc1/angular-route.min.js"></script>
  <script src="app/libs/bootstrap/dist/js/bootstrap.js"></script>
  <script src="app/libs/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js"></script>
  <script src="app/js/administrator.js"></script>
  <script>$.ajaxPrefilter(function( options, originalOptions, jqXHR ) { options.async = true; });</script>


</head>
<body>
	<div class="container-fluid" ng-controller="DbController">
		<div class="row">
			<div class="col-lg-2 col-mg-2 col-sm-2 hidden-xs block-left">
				<div class="userPhoto">
					<img src="app/images/1.jpg" alt="romek" class="img-responsive img-circle">
				</div>
				<div class="links">
					<ul class="nav nav-pills nav-stacked">
            <li>
              <a href="#/MemberList" class="en hide" ng-click="updateMembers()"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
              MEMBERS </a>
              <a href="#/MemberList" class="ukr" ng-click="updateMembers()"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
              РОБІТНИКИ </a>
            </li>
            <li>
              <a href="#/AddNewMember" class="en hide" ng-click="updateMembers_2()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              ADD NEW MEMBER </a>
              <a href="#/AddNewMember" class="ukr" ng-click="updateMembers_2()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              ДОДАТИ РОБІТНИКА </a>
            </li>
            <hr>
            <li>
              <a href="#/Positions" class="en hide" ng-click="updatePositions()"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> 
              POSITIONS </a>
              <a href="#/Positions" class="ukr" ng-click="updatePositions()"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> 
              ПОСАДИ </a>
            </li>
            <li>
              <a href="#/AddNewPosition" class="en hide" ng-click="updatePositions_2()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
              ADD NEW POSITION </a>
              <a href="#/AddNewPosition" class="ukr" ng-click="updatePositions_2()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
              ДОДАТИ ПОСАДУ </a>
            </li>
            <hr>
						<li> 
              <a href="#/Projects" class="en hide" ng-click="updateProjects()"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
               PROJECTS </a>
               <a href="#/Projects" class="ukr" ng-click="updateProjects()"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
               ПРОЕКТИ </a>
            </li>
            <li>
              <a href="#/AddNewProject" class="en hide" ng-click="updateProjects_2()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
              ADD NEW PROJECT </a>
              <a href="#/AddNewProject" class="ukr" ng-click="updateProjects_2()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
              ДОДАТИ ПРОЕКТ </a>
            </li>
            <hr>
            <li>
              <a href="#/ProjectCalendar" class="en hide" ng-click="updateProjectCalendar()"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
              PROJECTS CALENDAR </a>
              <a href="#/ProjectCalendar" class="ukr" ng-click="updateProjectCalendar()"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
              КАЛЕНДАР ПРОЕКТІВ </a>
            </li>
            <hr>
            <li>
              <a href="#/MakeReport" class="en hide" ng-click="updateProjectReport()"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> 
              MAKE REPORT </a>
              <a href="#/MakeReport" class="ukr" ng-click="updateProjectReport()"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> 
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
        <nav ng-include src="'app/templates/navigationMenuAdmin.html'"></nav>
				<!-- Navigation_end -->

				<!-- Main_start -->
				<div class="main-container">

          <div ng-include src="'app/templates/updateMember.html'"></div>

          <div ng-include src="'app/templates/updatePosition.html'"></div>

          <div ng-include src="'app/templates/updateProject.html'"></div>

          <ng-view></ng-view>
        
			  </div>
				<!-- Main_end -->

			</div>
		</div>
	</div>


<!-- LOG_OUT -->
<div ng-include src="'app/templates/logOut.html'"></div>


</body>
</html>