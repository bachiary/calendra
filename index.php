<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">


<?php

?>


<?php 

if(!$id){$id = $_POST ['var1'];}
require "connect.php" 
?>
<?php require "get_list.php" ?>


<head><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style>
<meta name="viewport" content="initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script type="text/javascript" src="https://code.angularjs.org/angular-1.0.1.js"></script>
      
<link rel="stylesheet" href="w3.css">

<style>


table {

    border-spacing: 30;
    width: 90%;
    height: 70%;
    border: 1px solid #ddd; 
}

th, td {
    border: none;
    text-align: center;
    padding: 8px;
}

table.tdtable td:hover {
background-color: grey;
}

td.top {
    vertical-align: top;
    border: 1px solid red;
}
td.bottom {
    vertical-align: bottom;
    border: 1px solid green;
}

h1 { color: #111; font-family: 'Open Sans Condensed', sans-serif; font-size: 32px; font-weight: 700; line-height: 64px; margin: 0 0 0; padding: 20px 30px; text-align: center; text-transform: uppercase; }


h2 { color: #111; font-family: 'Open Sans Condensed', sans-serif; font-size: 48px; font-weight: 700; line-height: 48px; margin: 0 0 24px; padding: 0 30px; text-align: center; text-transform: uppercase; }

h4 { color: navy; font-family: 'Open Sans Condensed', sans-serif;  font-size: 20px; }

p { color: #111; font-family: 'Open Sans', sans-serif; font-size: 16px; line-height: 28px; margin: 0 0 48px; }


a { color: #990000; text-decoration: none; }





.date { color: #111; display: block; font-family: 'Open Sans', sans-serif; font-size: 16px; position: relative; text-align: center; z-index: 1; }


.date:before { border-top: 1px solid #111; content: ""; position: absolute; top: 12px; left: 0; width: 100%; z-index: -1; }


.author { color: #111; display: block; font-family: 'Open Sans', sans-serif; font-size: 16px; padding-bottom: 38px; position: relative; text-align: center; z-index: 1; }


.author:before { border-top: 1px solid #111; content: ""; position: absolute; top: 12px; left: 0; width: 100%; z-index: -1; }


.date span,

.author span { background: #fdfdfd; padding: 0 10px; text-transform: uppercase; }


.line { border-top: 1px solid #111; display: block; margin-top: 60px; padding-top: 50px; position: relative; }


.read-more { -moz-border-radius: 50%; -moz-transition: all 0.2s ease-in-out; -webkit-border-radius: 50%; -webkit-transition: all 0.2s ease-in-out; background: #111; border-radius: 50%; border: 10px solid #fdfdfd; color: #fff; display: block; font-family: 'Open Sans', sans-serif; font-size: 14px; height: 80px; line-height: 80px; margin: -40px 0 0 -40px; position: absolute; bottom: 0px; left: 50%; text-align: center; text-transform: uppercase; width: 80px; }


.read-more:hover { background: #990000; text-decoration: none; }

.foot {
    position: fixed;
    bottom: 50;
    width: 100%;
    text-align: center;
    
}

</style>

<title>Calendra Adobe</title>


<script>

var datalayer = 
{ "pageName":"Calendra:edit",
"user":localStorage["nom"]||"Inconnu",
"group":localStorage["group"]||"None",
"statusAC":"",
"action":"",
"changeday":"",
"partday":""
};



if(!localStorage["nom"]){ localStorage["nom"] = "Jean-Marie";}
if(!localStorage["nomIndex"]){ localStorage["nomIndex"] = "0";}

function myAjax() {
vv = JSON.parse(localStorage["week"]);

for(var i = 0; i < vv.length; i++){vv[i].team="";}
console.log(vv);
var week =  'update.php?local=' + JSON.stringify(vv) + '&id=' + localStorage["nomIndex"];
$.ajax( { type : 'POST',
          data : { },
          url  : week,              
          success: function ( data ) {
            console.log(data);
          },
          error: function ( xhr ) {
            console.log( "error" );
          }
        });
}


function ChangeDD(value_person,value_name) {
datalayer.action = "Change User";
_satellite.track("action");


vv = value_person;
$("#var1").val(vv);
$("#form").submit();

localStorage["week"] = "";
localStorage["nom"] = value_name;
localStorage["nomIndex"] = value_person;
  
//window.location.search = 'id=' + value_person;


}


function Save() {
  console.log("DC:Save"); console.log($scope.week)
  localStorage["week"] = JSON.stringify($scope.week);
  localStorage["nom"] = $scope.person_name.split('"')[0];
  localStorage["nomIndex"] =   $scope.person_id;

 
};






</script>
<script src="https://assets.adobedtm.com/ed015bf1f294ad47b32bded889ba32e62ca6c25a/satelliteLib-624f054d82f9aea1b470f130cecba9dd1d037b23.js"></script>
  
</head>

<body ng-app="myApp" class="ng-scope">
  <div id="head1"  >
    .
  </div>
<form style="display: hidden" action="http://benjaminachiary.com/calendra/index.php" method="POST" id="form">
  <input type="hidden" id="var1" name="var1" value=""/>
  <input type="hidden" id="var2" name="var2" value=""/>
</form>




<div class="container-fluid" ng-controller="MyCtrl">
  <div class="row">
    <div class="col-md-12">
      
<label>Consultant	:</label>
<select name="person" ng-options="person.name as person.name for person in persons" ng-model="person_name" onChange="ChangeDD(this.value,options[this.value].text)">


</select>


      <h4>
 
  </h4>
      <table class="table table-bordered tdtable table-condensed">
        <thead>
         
            <th ng-click="addALLCreneau()">
             
            </th>
            <th ng-repeat="d in week" ng-click="addDay(d.day)">
              {{d.day}}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="h in hours" ng-click="">
            <td>

            </td>
            <td class="table-hover" ng-repeat="d in week" ng-click="addHere(d.hours[$parent.$index],d.day)">
		<i>{{d.team[$parent.$index].value}}</i>
       <h4 font-color=blue>{{ d.hours[$parent.$index].value  }}</h4> 

            </td>
          </tr>
        </tbody>
      </table>
    </div> </div>
</div>
  <button class="w3-btn w3-block w3-teal"" onClick="SaveACS()">
    Save in ACS
  </button>
<div ui-calendar="uiConfig.calendar" class="span8 calendar" ng-model="eventSources"></div>

</div>

<div ui-calendar="uiConfig.calendar" class="span8 calendar ng-pristine ng-valid" ng-model="eventSources"></div>

  <div class="foot" >
    
  </div>
  
  
  <div id="foot2"  >
    .
  </div>


  




<script type="text/javascript">//<![CDATA[



var myApp = angular.module('myApp', []);

function MyCtrl($scope) {
  $scope.hours = [{
    hour: "AM",
    value: ""
  }, {
    hour: "PM",
    value: ""
  }]





if(localStorage["week"]){
$scope.team = JSON.parse(localStorage["team"])
$scope.week = JSON.parse(localStorage["week"]);
var t1 = $scope.team[0][0].value.replace(localStorage["nom"],"");


$scope.team[0][0].value = $scope.team[0][0].value.replace(localStorage["nom"],"") + "(" + $scope.team[0][0].value.trim().split(/\s+/).length + ")";

$scope.team[0][1].value = $scope.team[0][1].value.replace(localStorage["nom"],"") + "(" + $scope.team[0][1].value.trim().split(/\s+/).length + ")";

$scope.team[1][0].value = $scope.team[1][0].value.replace(localStorage["nom"],"")+ "(" + $scope.team[1][0].value.trim().split(/\s+/).length + ")";
$scope.team[1][1].value = $scope.team[1][1].value.replace(localStorage["nom"],"")+ "(" + $scope.team[1][1].value.trim().split(/\s+/).length + ")";

$scope.team[2][0].value = $scope.team[2][0].value.replace(localStorage["nom"],"")+ "(" + $scope.team[2][0].value.trim().split(/\s+/).length + ")";
$scope.team[2][1].value = $scope.team[2][1].value.replace(localStorage["nom"],"")+ "(" + $scope.team[2][1].value.trim().split(/\s+/).length + ")";

$scope.team[3][0].value = $scope.team[3][0].value.replace(localStorage["nom"],"")+ "(" + $scope.team[3][0].value.trim().split(/\s+/).length + ")";
$scope.team[3][1].value = $scope.team[3][1].value.replace(localStorage["nom"],"")+ "(" + $scope.team[4][1].value.trim().split(/\s+/).length + ")";

$scope.team[4][0].value = $scope.team[4][0].value.replace(localStorage["nom"],"")+ "(" + $scope.team[4][0].value.trim().split(/\s+/).length + ")";
$scope.team[4][1].value = $scope.team[4][1].value.replace(localStorage["nom"],"")+ "(" + $scope.team[4][1].value.trim().split(/\s+/).length + ")";

$scope.week[0].team = $scope.team[0]
$scope.week[1].team = $scope.team[1]
$scope.week[2].team = $scope.team[2]
$scope.week[3].team = $scope.team[3]
$scope.week[4].team = $scope.team[4]
  
}
else{
$scope.team = [[{value: ""},{value: ""}],[{value: ""},{value: ""}],[{value: ""},{value: ""}],[{value: ""},{value: ""}],[{value: ""},{value: ""}]];
  $scope.week = [{
      day: "Lundi",
      hours: angular.copy($scope.hours),
      team : $scope.team[0]
    }, {
      day: "Mardi",
      hours: angular.copy($scope.hours),
      team : $scope.team[1]
    }, {
      day: "Mercredi",
      hours: angular.copy($scope.hours),
      team : $scope.team[2]
    }, {
      day: "Jeudi",
      hours: angular.copy($scope.hours),
      team : $scope.team[3]
    }, {
      day: "Vendredi",
      hours: angular.copy($scope.hours),
      team : $scope.team[4]
    }

  ]

 }
   


if(localStorage["team"] && window.location.search.indexOf("all")==-1)
{$scope.team = JSON.parse(localStorage["team"])}
else{
$scope.team = [[{value: ""},{value: ""}],[{value: ""},{value: ""}],[{value: ""},{value: ""}],[{value: ""},{value: ""}],[{value: ""},{value: ""}]];
}



  $scope.data = {
    selectedDay: "Lundi",
    selectedHourBegin: "AM",
    selectedHourEnd: null

  }
  
 



    $scope.persons = JSON.parse(localStorage["persons"])
    $scope.person_id = localStorage["nomIndex"];
    $scope.person_name = localStorage["nom"];
	



  $scope.addALLCreneau = function() {

    for (var i = 0; i < $scope.week.length; i++) {

      //if ($scope.week[i].day == $scope.data.selectedDay) {
        for (var j = 0; j < $scope.week[i].hours.length; j++) {
          if ($scope.isInCreneau($scope.week[i].hours[j].hour) == true) {

            $scope.week[i].hours[j].value = $scope.addPersonToCreneau($scope.week[i].hours[j].value);

            //Done
          }
        //}
      }
    }
        $scope.Save()
  };
  
  

  
  $scope.addDayCreneau = function(day) {

    for (var i = 0; i < $scope.week.length; i++) {
	  
      if ($scope.week[i].day == day) {
        for (var j = 0; j < $scope.week[i].hours.length; j++) {
          if ($scope.isInCreneau($scope.week[i].hours[j].hour) == true) {

            $scope.week[i].hours[j].value = $scope.addPersonToCreneau($scope.week[i].hours[j].value);

            //Done
          }
        }
      }
    }
    
  };
  
  
  $scope.isInCreneau = function(hour) {
    var isbetween = false;
    for (var x = 0; x < $scope.hours.length; x++) {
      if ($scope.hours[x].hour == $scope.data.selectedHourBegin)
        isbetween = true;
      if ($scope.hours[x].hour == hour && isbetween == true)
        return true
      if ($scope.hours[x].hour == $scope.data.selectedHourEnd)
        isbetween = false;
    }
    return false;
  };

  $scope.addPersonToCreneau = function(value) {
    
    
    //if(localStorage["week2"]){value = localStorage["week2"];}
    
    if ($scope.person_name == null)
      return value; 


    if (value.indexOf($scope.person_name) > -1) {

      var index = value.indexOf($scope.person_name);
      return (value.substring(0, index) + value.substring((index + $scope.person_name.length), value.length));
      

    } else
      return ( $scope.person_name);
    
  };



  $scope.addHere = function(data,day) {

    data.value = $scope.addPersonToCreneau(data.value);
    $scope.Save(data,day)
  };
  
    $scope.Save = function(data,day) {
  console.log("DC:Save:" + $scope.person_name + ":" + JSON.stringify(day)+ ":" + JSON.stringify(data.hour)); console.log($scope.week)
  localStorage["week"] = JSON.stringify($scope.week);
  localStorage["nom"] = $scope.person_name;
  localStorage["nomIndex"] =   $scope.person_id;

  if(data.value) {datalayer.action = "add time";} else {datalayer.action = "remove time";}
  datalayer.changeday =  JSON.stringify(day).replace(/\"/g,"");
  datalayer.partday =  JSON.stringify(data.hour).replace(/\"/g,"");
  _satellite.track("action");
   myAjax();

  
 
  };
  
   
    $scope.Reset = function() {
  console.log("DC:Save"); console.log($scope.week)
  localStorage["week"] = '[{"day":"Lundi","hours":[{"hour":"AM","value":""},{"hour":"PM","value":""}],"$$hashKey":"004"},{"day":"Mardi","hours":[{"hour":"AM","value":""},{"hour":"PM","value":""}],"$$hashKey":"006"},{"day":"Mercredi","hours":[{"hour":"AM","value":""},{"hour":"PM","value":""}],"$$hashKey":"008"},{"day":"Jeudi","hours":[{"hour":"AM","value":""},{"hour":"PM","value":""}],"$$hashKey":"00A"},{"day":"Vendredi","hours":[{"hour":"AM","value":""},{"hour":"PM","value":""}],"$$hashKey":"00C"}]';
  
  
   MyCtrl($scope)
   $scope.Save(data)

  };
  
   
  
    $scope.addDay = function(data) {
  
    $scope.addDayCreneau(data);
    $scope.Save(data)
  };
  
     $scope.addhours = function(data) {

    $scope.addhoursCreneau(data);
    //$scope.Save()
  };


}





//]]> 

</script>

  <script>
  
  
  // tell the embed parent frame the height of the content
  if (window.parent && window.parent.parent){
    window.parent.parent.postMessage(["resultsFrame", {
      height: document.body.getBoundingClientRect().height,
      slug: "4b1835gu"
    }], "*")

  }
  

  

</script>
<script>


if(localStorage["nom"] && localStorage["firstname"] && localStorage["nom"]!=localStorage["firstname"]){

$("#var1").val(localStorage["nomIndex"]);
console.log(localStorage["firstname"] + " vs " + localStorage["nom"]);
$("#form").submit();

}

function SaveACS() {
datalayer.pageName = "Calendra:Save ACS";
datalayer.action = "Save ACS";
datalayer.statusAC = "unknown";
_satellite.track("action");
$("#var1").val(localStorage["nomIndex"]);
$("#var2").val("save");
$("#form").submit();
 
};




</script>



<script type="text/javascript">_satellite.pageBottom();</script>
</body>
</html>

<?php 
$val = $_POST ['var2'];
if($val == "save"){require "get_jwt_token_adobe.php";} ?>
