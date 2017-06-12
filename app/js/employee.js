// Application module
(function () {

	var app = angular.module('ProjectManagerApp',['ngRoute']);

	app.config(function ($routeProvider) {
		$routeProvider

		.when('/', {
			templateUrl: '../../Project_Manager/templates/myTaskList.html'
		})

		.when('/MyProject', {
			templateUrl: '../../Project_Manager/templates/myProjectList.html'
		})

		.when('/AllTasks', {
			templateUrl: '../../Project_Manager/templates/allTasksList.html'
		})
		
		.when('/MyTasks', {
			templateUrl: '../../Project_Manager/templates/MyTaskList.html'
		})

		.when('/MyTaskCalendar', {
			templateUrl: '../../Project_Manager/templates/MyTaskCalendar.html'
		});

	});

	app.controller("DbController",['$scope','$http', function($scope,$http){

	//====================================
	//============= PROJECTS =============
	

	getInfoProj();
	function getInfoProj(){
		$http.post('../../Project_Manager/php/myProjDetails.php').success(function(data){
			console.log("Projects downloaded");
			$scope.projects = data;
			$http.post('../../Project_Manager/php/getProgressWidthEmployee.php').success(function(data){
			$(".progress-bar").width(data + '%');
		});
		});
	};

	//====================================
	//=============== TASKS ==============
	
	getInfoAllTasks();
	function getInfoAllTasks(){
		$http.post('../../Project_Manager/php/allTaskDetails.php').success(function(data){
			console.log("Tasks downloaded & updated");
			$scope.allTask = data;
		});
	};

	getInfoMyTasks();
	function getInfoMyTasks(){
		$http.post('../../Project_Manager/php/myTaskDetails.php').success(function(data){
			console.log("Tasks downloaded & updated");
			$scope.tasks = data;
		});
	};


	$scope.currenTask = {};
	$scope.editInfoTask = function(info){
		$scope.currentTask = info;
		$('#myTasksList').slideUp();
		$('#updateMyTask').slideToggle();
	};

	$scope.UpdateTask = function(info){
		$http.post('../../Project_Manager/php/updateMyTask.php',{

			"id":info.id,
			"description":info.description,
			"project_id":info.project_id,
			"status":info.status

			}).success(function(data){
				if (data !=null) {
					getInfoAllTasks();
					getInfoMyTasks();
					alert(data);
					console.log("Task updated");
				}
		});
	};

	$scope.setUpdateTask = function(id){
		$('#myTasksList').slideToggle();
		$('#updateMyTask').slideUp();
	};

	$scope.updateMyTaskBack = function(){
		$('#myTasksList').slideToggle();
		$('#updateMyTask').slideUp();
	};

	//====================================
	//========== CASCADE MODEL ===========

	
	// $scope.showStageTasks = function(info){
	// 	$http.post('../../Project_Manager/php/stagesTaskDetails.php',{

	// 		"stages_id":info.stages_id,

	// 		}).success(function(data){
	// 			if (data !=null) {
	// 			$scope.tasks_name = data;
	// 			console.log(data);
	// 		};
	// 	});
	// };


	//=============================
	//========= UPDATES ===========

	$scope.updateMyProject = function(){
		getInfoProj();
		$('#myTasksList').slideToggle();
		$('#updateMyTask').slideUp();
	};

	$scope.updateAllTasks = function(){
		getInfoAllTasks();
		$('#myTasksList').slideToggle();
		$('#updateMyTask').slideUp();
	};

	$scope.updateMyTasks = function(){
		getInfoMyTasks();
		$('#myTasksList').slideToggle();
		$('#updateMyTask').slideUp();
	};

	$scope.updateTaskCalendar = function(){
		$('#myTasksList').slideToggle();
		$('#updateMyTask').slideUp();
	};

	$scope.chooseLang = function(){
		$('.ukr').addClass('hide');
		$('.en').removeClass('hide');
	};



	}]);

})();



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





