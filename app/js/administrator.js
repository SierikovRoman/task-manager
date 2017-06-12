// Application module
(function () {

	var app = angular.module('AdministratorApp',['ngRoute']);

	app.config(function ($routeProvider) {
		$routeProvider

		.when('/', {
			templateUrl: '../templates/MembersList.html'
		})

		.when('/MemberList', {
			templateUrl: '../templates/MembersList.html'
		})
		
		.when('/AddNewMember', {
			templateUrl: '../../Project_Manager/templates/addNewMember.html'
		})

		.when('/Positions', {
			templateUrl: '../../Project_Manager/templates/PositionsList.html'
		})

		.when('/AddNewPosition', {
			templateUrl: '../../Project_Manager/templates/addNewPosition.html'
		})

		.when('/Projects', {
			templateUrl: '../../Project_Manager/templates/ProjectsList.html'
		})

		.when('/AddNewProject', {
			templateUrl: '../../Project_Manager/templates/addNewProject.html'
		})

		.when('/ProjectCalendar', {
			templateUrl: '../../Project_Manager/templates/ProjectsCalendar.html'
		})

		.when('/SaveReport', {
			templateUrl: '../../Project_Manager/templates/AdminReportSave.html'
		})

		.when('/MakeReport', {
			templateUrl: '../../Project_Manager/templates/AdminReport.html'
		});

	});


	//===========================================
	//================= LOGICA ==================

	app.controller("DbController",['$scope','$http', function($scope,$http){

	getLanguage();
	function getLanguage(){
		$http.post('../../Project_Manager/php/getLanguage.php').success(function(data){
			if(data == 'en'){
				$('.ukr').addClass('hide');
				$('.en').removeClass('hide');
			} else if (data == 'ukr'){
				$('.ukr').removeClass('hide');
				$('.en').addClass('hide');
			};
		});
	};

	getInfo();
		function getInfo(){ 
			$http.post('../../Project_Manager/php/empDetails.php').success(function(data){
				console.log("Member list downloaded");
				$scope.members = data;
			});
		};

	getPosID();
	function getPosID(){
		$http.post('../../Project_Manager/php/memberPositionDetails.php').success(function(data){
			console.log("Member Position list downloaded");
			$scope.posCount = data;
		});
	};

	getAccessType();
	function getAccessType(){
		$http.post('../../Project_Manager/php/memberAccessTypeDetails.php').success(function(data){
			console.log("Access type list downloaded");
			$scope.accessCount = data;
		});
	};

	// Insert New member to db
	$scope.insertNewMember = function(info){
		$http.post('../../Project_Manager/php/insertMember.php',{

			"name":info.name,
			"surname":info.surname,
			"email":info.email,
			"access_type":info.access_type,
			"pos_id":info.pos_id,
			"password":info.password

			}).success(function(data){
			if (data == true) {
				getInfo();
				getID();
				console.log("Added new member");
				console.log(info.name);
				console.log(info.surname);
				console.log(info.access_type);
				console.log(info.pos_id);
				console.log(info.password);
			};
		});
	};

	// Delete member from db
	$scope.deleteInfo = function(info){
		$http.post('../../Project_Manager/php/deleteDetails.php',{

			"del_id":info.id

			}).success(function(data){
			if (data !=null) {
				getInfo();
			};
		});
	};


	$scope.currentUser = {};
	$scope.editInfo = function(info){
		$scope.currentUser = info;
		$('#membersList').slideUp();
		$('#updateMember').slideToggle();
	};

	$scope.UpdateInfo = function(info){
		console.log("Updated");
		$http.post('../../Project_Manager/php/updateDetails.php',{

			"id":info.id,
			"name":info.name,
			"surname":info.surname,
			"email":info.email,
			"access_id":info.access_id,
			"position_id":info.position_id,
			"password":info.password

			}).success(function(data){
				if (data != null) {
					getInfo();
					console.log(info.id);
					console.log(info.name);
					console.log(info.surname);
					console.log(info.email);
					console.log(info.access_id);
					console.log(info.position_id);
					console.log(info.password);
				};
		});
	};

	$scope.updateMsg = function(id){
		$('#membersList').slideToggle();
		$('#updateMember').slideUp();
	}

	$scope.updateBack = function(){
		getInfo();
		$('#membersList').slideToggle();
		$('#updateMember').slideUp();
	}

	//====================================
	//============ POSITION ==============

	$scope.insertNewPosition = function(info){
		$http.post('../../Project_Manager/php/insertPosition.php',{

			"pos_name":info.pos_name

			}).success(function(data){
			if (data != null) {
				getPosID();
				getAccessType();
			};
		});
	};

	$scope.currentPosition = {};
	$scope.editPosition = function(info){
		$scope.currentPosition = info;
		$('#positionList').slideUp();
		$('#UpdatePosition').slideToggle();
	};

	$scope.UpdatePosition = function(info){
		//console.log("Updated");
		$http.post('../../Project_Manager/php/updatePosition.php',{

			"id":info.id,
			"pos_name":info.pos_name

			}).success(function(data){
				if (data == true) {
					getInfo();
					getPosID();
					getAccessType();
					console.log("Position updated");
					console.log(info.id);
					console.log(info.name);
				}
		});
	};

	$scope.setUpdatePosition = function(id){
		$('#positionList').slideToggle();
		$('#UpdatePosition').slideUp();
	}

	$scope.updatePositionBack = function(){
		getPosID();
		$('#positionList').slideToggle();
		$('#UpdatePosition').slideUp();
	}

	$scope.deletePosition = function(info){
		$http.post('../../Project_Manager/php/deletePosition.php',{

			"del_id":info.id

			}).success(function(data){
			if (data == true) {
				getInfo();
				getPosID();
				getAccessType();
				console.log("Position deleted");
			};
		});
	};

	//====================================
	//============ PROJECTS ==============
	

	getInfoProj();
	function getInfoProj(){
		$http.post('../../Project_Manager/php/projDetails.php').success(function(data){
			console.log("Project list downloaded & updated"); 
			$scope.projects = data;
			
			angular.forEach($scope.projects, function(inf){
				$scope.progress = inf.progress;
			});
			var p = $scope.progress;
			$(".progress-bar").width(p + '%');
		});
	};

	getID();
	function getID(){
		$http.post('../../Project_Manager/php/freeProjectManagerDetails.php').success(function(data){
			console.log("Project Manager list downloaded");
			$scope.projectManagers = data;
		});
	};

	// Insert New project to db
	$scope.insertNewProject = function(info){
		$http.post('../../Project_Manager/php/insertProject.php',{

			"title":info.title,
			"start_dt":info.start_dt,
			"end_dt":info.end_dt,
			"emp_id":info.emp_id

			}).success(function(data){
			if (data !=null) {
				getInfoProj();
				console.log("Added new project");
			};
		});
	};

	// Delete project from db
	$scope.deleteInfoProject = function(info){
		$http.post('../../Project_Manager/php/deleteProject.php',{

			"id":info.id

			}).success(function(data){
			if (data == true) {
				getInfoProj();
				console.log("Project deleted");
			};
		});
	};

	// Update project to db
	$scope.currentProject = {};
	$scope.editInfoProject = function(info){
		$scope.currentProject = info;
		$('#projectList').slideUp();
		$('#updateProject').slideToggle();
		$http.post('../../Project_Manager/php/projectManagerDetails.php', {

			"id":info.id

		}).success(function(data){
			console.log("Project Manager list downloaded");
			$scope.projCount = data;
		});
	};

	$scope.UpdateProject = function(info){
		$http.post('../../Project_Manager/php/updateProjectDetails.php',{

			"id":info.id,
			"title":info.title,
			"start_dt":info.start_dt,
			"end_dt":info.end_dt,
			"emp_id":info.emp_id

			}).success(function(data){
				if (data == true) {
					getInfoProj();
					console.log("Project updated");
					console.log(data);
				}
		});
	};

	$scope.setUpdateProject = function(id){
		$('#projectList').slideToggle();
		$('#updateProject').slideUp();
	}

	$scope.updateProjectBack = function(){
		getInfoProj();
		$('#projectList').slideToggle();
		$('#updateProject').slideUp();
	}

	//====================================
	//============== REPORT ==============

	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();

	if(dd<10) {
	    dd='0'+dd
	} 

	if(mm<10) {
	    mm='0'+mm
	} 

	today = mm+'/'+dd+'/'+yyyy;

	$scope.choosenProject = {};
	$scope.choosenTasks = {};
	$scope.getProjectInfo = function(info){
		$http.post('../../Project_Manager/php/getProjectInfo.php',{

			"project_id":info.project_id

			}).success(function(data){
			if (data !=null) {
				console.log("success-1");
				console.log(data);
				$scope.choosenProject = data;
			};
		});
		$http.post('../../Project_Manager/php/getProjectTaskInfo.php',{

			"project_id":info.project_id

			}).success(function(data){
			if (data !=null) {
				console.log("success-2");
				console.log(data);
				$scope.choosenTasks = data;
				$scope.local_date = today;
			};
		});
	}

	//====================================
	//============= UPDATES ==============

	$scope.updateMembers = function(){
		getInfo();
		$('#projectList, #positionList, #membersList').slideToggle();
		$('#updateProject, #UpdatePosition, #updateMember').slideUp();
	};

	$scope.updateMembers_2 = function(){
		$('#projectList, #positionList, #membersList').slideToggle();
		$('#updateProject, #UpdatePosition, #updateMember').slideUp();
	};

	$scope.updatePositions = function(){
		getPosID();
		$('#projectList, #positionList, #membersList').slideToggle();
		$('#updateProject, #UpdatePosition, #updateMember').slideUp();
	};

	$scope.updatePositions_2 = function(){
		$('#projectList, #positionList, #membersList').slideToggle();
		$('#updateProject, #UpdatePosition, #updateMember').slideUp();
	};

	$scope.updateProjects = function(){
		getInfoProj();
		$('#projectList, #positionList, #membersList').slideToggle();
		$('#updateProject, #UpdatePosition, #updateMember').slideUp();
	};

	$scope.updateProjects_2 = function(){
		$('#projectList, #positionList, #membersList').slideToggle();
		$('#updateProject, #UpdatePosition, #updateMember').slideUp();
	};

	$scope.updateProjectCalendar = function(){
		$('#projectList, #positionList, #membersList').slideToggle();
		$('#updateProject, #UpdatePosition, #updateMember').slideUp();
	};

	$scope.updateProjectReport = function(){
		$('#projectList, #positionList, #membersList').slideToggle();
		$('#updateProject, #UpdatePosition, #updateMember').slideUp();
	};

	$scope.chooseLang = function(){
		$http.post('../../Project_Manager/php/chooseLang.php').success(function(data){
			if(data == 'en'){
				$('.ukr').addClass('hide');
				$('.en').removeClass('hide');
			} else if (data == 'ukr'){
				$('.ukr').removeClass('hide');
				$('.en').addClass('hide');
			};
		});
		// $('.ukr').addClass('hide');
		// $('.en').removeClass('hide');
	};

	}]);

})();



	//====================================
	//============== DESIGN ==============


	function new_position(){
		$('#new_position').modal('show');
	};

	function new_member(){
		$('#new_member').modal('show');
	};

	function new_project(){
		$('#new_project').modal('show');
	};


	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true
	});

	// функция узнает размер окна браузера, и задает её для блока div
	function fullHeight(){
	    $('.block-left').css({
	        height: $(window).height() + 'px'
	    });
	};
	 
	// задаем высоту при первичной загрузке
	fullHeight();
	 
	// высота при изменении размера окна браузера
	$(window).resize( fullHeight );




