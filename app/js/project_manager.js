// Application module
(function () {

	var app = angular.module('ProjectManagerApp',['ngRoute']);

	app.config(function ($routeProvider) {
		$routeProvider

		.when('/', {
			templateUrl: '../../Project_Manager/templates/MemberList.html'
		})

		.when('/MemberList', {
			templateUrl: '../../Project_Manager/templates/MemberList.html'
		})

		.when('/MyProject', {
			templateUrl: '../../Project_Manager/templates/ProjectList.html'
		})

		.when('/Models', {
			templateUrl: '../../Project_Manager/templates/Models.html'
		})

		.when('/AddNewModel', {
			templateUrl: '../../Project_Manager/templates/addNewModel.html'
		})

		.when('/Stages', {
			templateUrl: '../../Project_Manager/templates/myStages.html'
		})

		.when('/AddNewStages', {
			templateUrl: '../../Project_Manager/templates/addNewStage.html'
		})

		.when('/AllTasks', {
			templateUrl: '../../Project_Manager/templates/TasksList.html'
		})
		
		.when('/StagesTasks', {
			templateUrl: '../../Project_Manager/templates/StagesTasksList.html'
		})

		.when('/AddNewTask', {
			templateUrl: '../../Project_Manager/templates/addNewTask.html'
		})

		.when('/TaskCalendar', {
			templateUrl: '../../Project_Manager/templates/TaskCalendar.html'
		})

		.when('/SaveReport', {
			templateUrl: '../../Project_Manager/templates/ProjectManagerReportSave.html'
		})

		.when('/MakeReport', {
			templateUrl: '../../Project_Manager/templates/ProjectManagerReport.html'
		});

	});

	app.controller("DbController",['$scope','$http', function($scope,$http){

	//====================================
	//============= MEMBERS =============
	
	getInfo();
		function getInfo(){
			$http.post('../../Project_Manager/php/empDetails.php').success(function(data){
				console.log("Members dowloaded");
				$scope.members = data;
			});
		};

	//====================================
	//============= PROJECTS =============
	

	getInfoProj();
	function getInfoProj(){
		$http.post('../../Project_Manager/php/projDetails.php').success(function(data){
			console.log("Projects downloaded");
			$scope.projects = data;
			// alert(data);
		});
	};

	getProgress();
	function getProgress(){
		$http.post('../../Project_Manager/php/getProgress.php').success(function(data){
			console.log("Progress downloaded");
			//$scope.progres = data;
			$(".progress-bar").width(data + '%');
		});
	};

	
	getModel();
	function getModel(){
		$http.post('../../Project_Manager/php/getModels.php').success(function(data){
			console.log("Models list downloaded");
			$scope.modelCount = data;
		});
	};

	$scope.currenProject = {};
	$scope.editInfoProject = function(info){
		$scope.currentProject = info;
		$('#projectList').slideUp();
		$('#updateProjectModel').slideToggle();
	};

	$scope.UpdateProject = function(info){
		$http.post('../../Project_Manager/php/updateProjectModel.php',{

			"id":info.id,
			"title":info.title,
			"start_dt":info.start_dt,
			"end_dt":info.end_dt,
			"progress":info.progress,
			"model_id":info.model_id

			}).success(function(data){
				if (data !=null) {
					getInfoProj();
					getStageID();
					getInfoTasks();
					console.log("Project updated");
					console.log(info.id);
					console.log(info.title);
					console.log(info.start_dt);
					console.log(info.end_dt);
					console.log(info.progress);
					console.log(info.model_id);
				}
		});
	};

	$scope.setUpdateProject = function(id){
		$('#projectList').slideToggle();
		$('#updateProjectModel').slideUp();
	};

	$scope.updateProjectModelBack = function(){
		getInfoProj();
		$('#projectList').slideToggle();
		$('#updateProjectModel').slideUp();
	};


	//==========================================
	//============= MODELS & STAGES ============
	
	getMyModels();
	function getMyModels(){
		$http.post('../../Project_Manager/php/getMyModels.php').success(function(data){
			console.log("My Models downloaded & updated");
			$scope.models = data;
		});
	};

	$scope.currentModel = {};
	$scope.getMyModel = function(info){
		$scope.currentModel = info;
		$http.post('../../Project_Manager/php/getMyStages.php',{

			"id":info.id

		}).success(function(data){
			$scope.myStages = data;
		});
	};

	// Insert Model to db
	$scope.insertNewModel = function(info){
		$http.post('../../Project_Manager/php/insertModel.php',{

			"name":info.name

			}).success(function(data){
			if (data !=null) {
				getInfoTasks();
				getModel();
				getMyModels();
				console.log("Added new model");
				console.log(data);
				$('#my_new_model').val("");
				$('#success_m').modal('show');
			};
		});
	};

	$scope.currentModel = {};
	$scope.editModel = function(info){
		$scope.currentModel = info;
		$('#modelsList1, #modelsList2').slideUp();
		$('#updateModel').slideToggle();
	};

	$scope.updateMyModel = function(info){
		//console.log("Updated");
		$http.post('../../Project_Manager/php/updateMyModel.php',{

			"id":info.id,
			"name":info.name

			}).success(function(data){
				if (data !=null) {
					getInfoTasks();
					getMyModels();
					getModel();
					console.log("My Model updated");
				}
		});
	};

	$scope.setUpdateMyModel = function(id){
		$('#modelsList1, #modelsList2').slideToggle();
		$('#updateModel').slideUp();
	};

	$scope.updateModelBack = function(){
		getMyModels();
		getModel();
		$('#modelsList1, #modelsList2').slideToggle();
		$('#updateModel').slideUp();
	};

	// Delete model from db
	$scope.deleteModel = function(info){
		$http.post('../../Project_Manager/php/deleteMyModel.php',{

			"id":info.id

			}).success(function(data){
			if (data == true) {
				getMyModels();
				getModel();
				getInfoTasks();
				$('#del_model').modal('show');
				console.log("Model - # " + info.id + " was deleted");
			};
		});
	};

	// Insert Stage to db
	$scope.insertNewStage = function(info){
		$http.post('../../Project_Manager/php/insertStage.php',{

			"model_id":info.model_id,
			"name":info.name

			}).success(function(data){
			if (data !=null) {
				getInfoTasks();
				getMyModels();
				console.log("Added new Stage");
				$('#stageName').val("");
				$('#success').modal('show');
			};
		});
	};

	$scope.showStage = function(info){
		$http.post('../../Project_Manager/php/getMyStages.php',{

			"id":info.model_id

		}).success(function(data){
			$scope.My_Stages = data;
		});
	};

	// Delete stages from db
	$scope.deleteStage = function(info){
		$http.post('../../Project_Manager/php/deleteStage.php',{

			"id":info.id

			}).success(function(data){
			if (data != null) {
				getMyModels();
				getModel();
				getInfoTasks();
				alert("DELETED");
				console.log("Stage - # " + info.id + " was deleted");
			};
		});
	};

	// Update Stage
	$scope.currentStage = {};
	$scope.editStage = function(info){
		$scope.currentStage = info;
		$('.myStages').slideUp();
		$('#updateStage').slideToggle();
	};

	$scope.updateMyStage = function(info){
		$http.post('../../Project_Manager/php/updateMyStage.php',{

			"id":info.id,
			"name":info.name

			}).success(function(data){
				if (data !=null) {
					getInfoTasks();
					getMyModels();
					getModel();
					console.log("My Model updated");
				}
		});
	};

	$scope.setUpdateMyStage = function(id){
		$('.myStages').slideToggle();
		$('#updateStage').slideUp();
	};

	$scope.updateStageBack = function(){
		$('.myStages').slideToggle();
		$('#updateStage').slideUp();
	};

	//=================================
	//============= TASKS =============
	

	getInfoTasks();
	function getInfoTasks(){
		$http.post('../../Project_Manager/php/taskDetails.php').success(function(data){
			console.log("Tasks downloaded & updated");
			$scope.tasks = data;
		});
	};


	getMemberID();
	function getMemberID(){
		$http.post('../../Project_Manager/php/getExecutors.php').success(function(data){
			console.log("Member list downloaded");
			$scope.memberCount = data;
		});
	};

	getStageID();
	function getStageID(){
		$http.post('../../Project_Manager/php/getStages.php').success(function(data){
			console.log("Stage list downloaded");
			$scope.stageCount = data;
		});
	};


	// Insert New task to db
	$scope.insertNewTask = function(info){
		$http.post('../../Project_Manager/php/insertTask.php',{

			"title":info.title,
			"description":info.description,
			"start_dt":info.start_dt,
			"end_dt":info.end_dt,
			"executor_id":info.executor_id,
			"stage_id":info.stage_id,
			"project_id":info.project_id,
			"status":info.status

			}).success(function(data){
			if (data !=null) {
				getInfoTasks();
				console.log("Added new task");
			};
		});
	};

	// Delete task from db
	$scope.deleteInfoTask = function(info){
		$http.post('../../Project_Manager/php/deleteTask.php',{

			"id":info.id

			}).success(function(data){
			if (data == true) {
				getInfoTasks();
				console.log("Task - # " + info.id + " was deleted");
			};
		});
	};

	$scope.currenTask = {};
	$scope.editInfoTask = function(info){
		$scope.currentTask = info;
		$('#tasksList, .stagesTask').slideUp();
		$('#updateTask').slideToggle();
	};

	$scope.UpdateTask = function(info){
		$http.post('../../Project_Manager/php/updateTask.php',{

			"id":info.id,
			"title":info.title,
			"description":info.description,
			"start_dt":info.start_dt,
			"end_dt":info.end_dt,
			"executor_id":info.executor_id,
			"stage_id":info.stage_id,
			"project_id":info.project_id,
			"status":info.status

			}).success(function(data){
				if (data !=null) {
					getInfoTasks();
					console.log("Project updated");
				}
		});
	};

	$scope.setUpdateTask = function(id){
		$('#tasksList').slideToggle();
		$('#updateTask').slideUp();
	};

	$scope.updateTaskBack = function(){
		getInfoTasks();
		$('#tasksList, .stagesTask').slideToggle();
		$('#updateTask').slideUp();
	};


	//====================================
	//============== STAGES ==============

	
	$scope.showStageTasks = function(info){
		$http.post('../../Project_Manager/php/stagesTaskDetails.php',{

			"stages_id":info.stages_id,

			}).success(function(data){
				if (data !=null) {
				$scope.tasks_name = data;
				console.log(data);
			};
		});
	};

	//=============================
	//========= REPORT ===========
	
	// $scope.getProjectDetails = function(info){
	// 	$http.post('../../Project_Manager/php/stagesTaskDetails.php',{

	// 		"stages_id":info.stages_id,

	// 		}).success(function(data){
	// 			if (data !=null) {
	// 			$scope.projects = data;
	// 		};
	// 	});
	// };
	
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

	//=============================
	//========= UPDATES ===========

	$scope.updateMembers = function(){
		getInfo();
		$('#projectList, #modelsList1, #modelsList2, .myStages, #tasksList, .stagesTask').slideToggle();
		$('#updateProjectModel, #updateModel, #updateStage, #updateTask').slideUp();

	};

	$scope.updateProjects = function(){
		getInfoProj();
		$('#projectList, #modelsList1, #modelsList2, .myStages, #tasksList, .stagesTask').slideToggle();
		$('#updateProjectModel, #updateModel, #updateStage, #updateTask').slideUp();
	};

	$scope.updateModels = function(){
		getInfoProj();
		$('#projectList, #modelsList1, #modelsList2, .myStages, #tasksList, .stagesTask').slideToggle();
		$('#updateProjectModel, #updateModel, #updateStage, #updateTask').slideUp();
	};

	$scope.updateModels_2 = function(){
		$('#projectList, #modelsList1, #modelsList2, .myStages, #tasksList, .stagesTask').slideToggle();
		$('#updateProjectModel, #updateModel, #updateStage, #updateTask').slideUp();
	};

	$scope.updateStages = function(){
		getInfoTasks();
		$('#projectList, #modelsList1, #modelsList2, .myStages, #tasksList, .stagesTask').slideToggle();
		$('#updateProjectModel, #updateModel, #updateStage, #updateTask').slideUp();
	};

	$scope.updateStages_2 = function(){
		$('#projectList, #modelsList1, #modelsList2, .myStages, #tasksList, .stagesTask').slideToggle();
		$('#updateProjectModel, #updateModel, #updateStage, #updateTask').slideUp();
	};

	$scope.updateTasks = function(){
		getInfoTasks();
		$('#projectList, #modelsList1, #modelsList2, .myStages, #tasksList, .stagesTask').slideToggle();
		$('#updateProjectModel, #updateModel, #updateStage, #updateTask').slideUp();
	};

	$scope.updateTasks_2 = function(){
		$('#projectList, #modelsList1, #modelsList2, .myStages, #tasksList, .stagesTask').slideToggle();
		$('#updateProjectModel, #updateModel, #updateStage, #updateTask').slideUp();
	};

	$scope.updateStagesTasks = function(){
		$('#projectList, #modelsList1, #modelsList2, .myStages, #tasksList, .stagesTask').slideToggle();
		$('#updateProjectModel, #updateModel, #updateStage, #updateTask').slideUp();
	};

	$scope.updateTaskCalendar = function(){
		$('#projectList, #modelsList1, #modelsList2, .myStages, #tasksList, .stagesTask').slideToggle();
		$('#updateProjectModel, #updateModel, #updateStage, #updateTask').slideUp();
	};

	$scope.updateTaskReport = function(){
		$('#projectList, #modelsList1, #modelsList2, .myStages, #tasksList, .stagesTask').slideToggle();
		$('#updateProjectModel, #updateModel, #updateStage, #updateTask').slideUp();
	};

	$scope.chooseLang = function(){
		$('.ukr').addClass('hide');
		$('.en').removeClass('hide');
	};



	}]);

})();


	//
	
	function new_model(){
		$('#new_model').modal('show');
	};

	function new_stage(){
		$('#new_stage').modal('show');
	};

	function new_stage_task(){
		$('#new_stage_task').modal('show');
	};





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





