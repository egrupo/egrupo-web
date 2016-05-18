//Chart
var pieOptions = {
	segmentShowStroke : false,
	animateRotate : true,
	animateScale : false,
	animation : false
};

var barOptions = {
	barShowStroke: false,
	scaleBeginAtZero: true,
	scaleShowHorizontalLines: false,
	scaleShoeVerticalLines: false,
	barValueSpacing: 20,
	barDatasetSpacing: 2
};

var options = {

};

function drawAssiduidade(){
	// var data_assiduidade = {

	// 	labels: days.reverse(),
	// 	datasets: [
	//         {
	//             label: "Alc",
	//             fillColor: "rgba(249,191,59,0.7)",
	//             strokeColor: "rgba(249,191,59,1)",
	//             pointColor: "rgba(249,191,59,1)",
	//             data: presencas_alc.reverse()
	//         },
	//         {
	//             label: "TEs",
	//             fillColor: "rgba(30,130,75,0.2)",
	//             strokeColor: "rgba(30,130,75,1)",
	//             pointColor: "rgba(30,130,75,1)",
	//             data: presencas_tes.reverse()
	//         }
	//         ,
	//         {
	//             label: "TEx",
	//             fillColor: "rgba(31, 58, 147,0.2)",
	//             strokeColor: "rgba(31, 58, 147,1)",
	//             pointColor: "rgba(31, 58, 147,1)",
	//             data: presencas_tex.reverse()
	//         },
	//         {
	//             label: "Cla",
	//             fillColor: "rgba(246, 71, 71,0.2)",
	//             strokeColor: "rgba(246, 71, 71,1)",
	//             pointColor: "rgba(246, 71, 71,1)",
	//             data: presencas_cla.reverse()
	//         }
	//     ]
	// }

	// var ctx3 = document.getElementById('chart-assiduidade').getContext("2d");
	// new Chart(ctx3).Line(data_assiduidade,options);
}

$(function() {	

	var data = [
	    {
	        value: parseInt($('#num-alc').val()),
	        color:"#F9BF3B",
	        highlight: "#FDE3A7",
	        label: "#Alcateia"
	    },
	    {
	        value: parseInt($('#num-tes').val()),
	        color: "#1E824C",
	        highlight: "#00B16A",
	        label: "#TEs"
	    },
	    {
	        value: parseInt($('#num-tex').val()),
	        color: "#1F3A93",
	        highlight: "#1E8BC3",
	        label: "#TEx"
	    },
	    {
	        value: parseInt($('#num-cla').val()),
	        color: "#F64747",
	        highlight: "#D64541",
	        label: "#Clã"
	    },
	    {
	        value: parseInt($('#num-che').val()),
	        color: "#FAFAFA",
	        highlight: "#F5F5F5",
	        label: "#Chefia"
	    }
	]
	var ctx = document.getElementById('chart-escoteiros').getContext("2d");
	new Chart(ctx).Pie(data,pieOptions);

	/* #Etapas */
	var data_bar = {
	    labels: ["Alcateia", "TEs", "TEx", "Clã"],
	    datasets: [
	        {
	            label: "1ª Etapa",
	            fillColor: "rgba(244,208,63,1)",
	            strokeColor: "rgba(244,208,63,1)",
	            highlightFill: "rgba(244,208,63,0.5)",
	            highlightStroke: "rgba(244,208,63,0.5)",
	            data: [$('#num-alc-1').val(), $('#num-tes-1').val(), $('#num-tex-1').val(), $('#num-cla-1').val()]
	        },
	        {
	            label: "2ª Etapa",
	            fillColor: "rgba(38,166,91,1)",
	            strokeColor: "rgba(38,166,91,1)",
	            highlightFill: "rgba(38,166,91,0.5)",
	            highlightStroke: "rgba(38,166,91,0.5)",
	            data: [$('#num-alc-2').val(), $('#num-tes-2').val(), $('#num-tex-2').val(), $('#num-cla-2').val()]
	        },
	        {
	            label: "3ª Etapa",
	            fillColor: "rgba(142,68,173,1)",
	            strokeColor: "rgba(142,68,173,1)",
	            highlightFill: "rgba(142,68,173,0.5)",
	            highlightStroke: "rgba(142,68,173,0.5)",
	            data: [$('#num-alc-3').val(), $('#num-tes-3').val(), $('#num-tex-3').val(), $('#num-cla-3').val()]
	        }
	    ]
	};

	var ctx2 = document.getElementById('chart-etapas').getContext("2d");
	new Chart(ctx2).Bar(data_bar,barOptions);

	// drawAssiduidade();

	window.myObjBar = new Chart(ctx2).Bar(data_bar,barOptions);

    //Fill Color
	myObjBar.datasets[0].bars[0].fillColor = "rgba(249, 191, 59, 0.4)"; //alc 1
    myObjBar.datasets[0].bars[1].fillColor = "rgba(30, 130, 76, 0.4)"; //tes 1
    myObjBar.datasets[0].bars[2].fillColor = "rgba(31, 58, 147, 0.4)"; //tex 1
    myObjBar.datasets[0].bars[3].fillColor = "rgba(246, 71, 71, 0.4)"; //cla 1

    myObjBar.datasets[1].bars[0].fillColor = "rgba(249, 191, 59, 0.65)"; //alc 2 
    myObjBar.datasets[1].bars[1].fillColor = "rgba(30, 130, 76, 0.65)"; //tes 2
    myObjBar.datasets[1].bars[2].fillColor = "rgba(31, 58, 147, 0.65)"; //tex 2
    myObjBar.datasets[1].bars[3].fillColor = "rgba(246, 71, 71, 0.65)"; //cla 2

    myObjBar.datasets[2].bars[0].fillColor = "rgba(249, 191, 59, 1)"; //alc 3
    myObjBar.datasets[2].bars[1].fillColor = "rgba(30, 130, 76, 1)"; //tes 3
    myObjBar.datasets[2].bars[2].fillColor = "rgba(31, 58, 147, 1)"; //tex 3
    myObjBar.datasets[2].bars[3].fillColor = "rgba(246, 71, 71, 1)"; //cla 3

    //Stroke Color
	myObjBar.datasets[0].bars[0].strokeColor = "rgba(249, 191, 59, 0.4)"; //alc 1
    myObjBar.datasets[0].bars[1].strokeColor = "rgba(30, 130, 76, 0.4)"; //tes 1
    myObjBar.datasets[0].bars[2].strokeColor = "rgba(31, 58, 147, 0.4)"; //tex 1
    myObjBar.datasets[0].bars[3].strokeColor = "rgba(246, 71, 71, 0.4)"; //cla 1

    myObjBar.datasets[1].bars[0].strokeColor = "rgba(249, 191, 59, 0.65)"; //alc 2 
    myObjBar.datasets[1].bars[1].strokeColor = "rgba(30, 130, 76, 0.65)"; //tes 2
    myObjBar.datasets[1].bars[2].strokeColor = "rgba(31, 58, 147, 0.65)"; //tex 2
    myObjBar.datasets[1].bars[3].strokeColor = "rgba(246, 71, 71, 0.65)"; //cla 2

    myObjBar.datasets[2].bars[0].strokeColor = "rgba(249, 191, 59, 1)"; //alc 3
    myObjBar.datasets[2].bars[1].strokeColor = "rgba(30, 130, 76, 1)"; //tes 3
    myObjBar.datasets[2].bars[2].strokeColor = "rgba(31, 58, 147, 1)"; //tex 3
    myObjBar.datasets[2].bars[3].strokeColor = "rgba(246, 71, 71, 1)"; //cla 3

    //Hightlight fill Color
	myObjBar.datasets[0].bars[0].highlightFill = "rgba(249, 191, 59, 0.4)"; //alc 1
    myObjBar.datasets[0].bars[1].highlightFill = "rgba(30, 130, 76, 0.4)"; //tes 1
    myObjBar.datasets[0].bars[2].highlightFill = "rgba(31, 58, 147, 0.4)"; //tex 1
    myObjBar.datasets[0].bars[3].highlightFill = "rgba(246, 71, 71, 0.4)"; //cla 1

    myObjBar.datasets[1].bars[0].highlightFill = "rgba(249, 191, 59, 0.65)"; //alc 2 
    myObjBar.datasets[1].bars[1].highlightFill = "rgba(30, 130, 76, 0.65)"; //tes 2
    myObjBar.datasets[1].bars[2].highlightFill = "rgba(31, 58, 147, 0.65)"; //tex 2
    myObjBar.datasets[1].bars[3].highlightFill = "rgba(246, 71, 71, 0.65)"; //cla 2

    myObjBar.datasets[2].bars[0].highlightFill = "rgba(249, 191, 59, 1)"; //alc 3
    myObjBar.datasets[2].bars[1].highlightFill = "rgba(30, 130, 76, 1)"; //tes 3
    myObjBar.datasets[2].bars[2].highlightFill = "rgba(31, 58, 147, 1)"; //tex 3
    myObjBar.datasets[2].bars[3].highlightFill = "rgba(246, 71, 71, 1)"; //cla 3

    //Highligh stroke Color
	myObjBar.datasets[0].bars[0].highlightStroke = "rgba(249, 191, 59, 0.4)"; //alc 1
    myObjBar.datasets[0].bars[1].highlightStroke = "rgba(30, 130, 76, 0.4)"; //tes 1
    myObjBar.datasets[0].bars[2].highlightStroke = "rgba(31, 58, 147, 0.4)"; //tex 1
    myObjBar.datasets[0].bars[3].highlightStroke = "rgba(246, 71, 71, 0.4)"; //cla 1

    myObjBar.datasets[1].bars[0].highlightStroke = "rgba(249, 191, 59, 0.65)"; //alc 2 
    myObjBar.datasets[1].bars[1].highlightStroke = "rgba(30, 130, 76, 0.65)"; //tes 2
    myObjBar.datasets[1].bars[2].highlightStroke = "rgba(31, 58, 147, 0.65)"; //tex 2
    myObjBar.datasets[1].bars[3].highlightStroke = "rgba(246, 71, 71, 0.65)"; //cla 2

    myObjBar.datasets[2].bars[0].highlightStroke = "rgba(249, 191, 59, 1)"; //alc 3
    myObjBar.datasets[2].bars[1].highlightStroke = "rgba(30, 130, 76, 1)"; //tes 3
    myObjBar.datasets[2].bars[2].highlightStroke = "rgba(31, 58, 147, 1)"; //tex 3
    myObjBar.datasets[2].bars[3].highlightStroke = "rgba(246, 71, 71, 1)"; //cla 3

    myObjBar.update();

   
});

function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
