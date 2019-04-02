



$(document).ready(function() {
  var urlChart = URL_2 + "admin/thongke/sanPhamBanChay";

  $.ajax({
    url: urlChart,
    type: "GET",
    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  }).done(function(res){
    var dt = res.message.duLieuThongKe;
    var luu = 0;
    var result = "";

    chartData = [];
    chartUnit = [];

    for(i=0; i<=dt.length-1; i++) {
        mau = "rgb(" +Math.floor(Math.random() * 255)+ "," +Math.floor(Math.random() * 255)+ "," +Math.floor(Math.random() * 255)+")";
        
        var test = {
    			"values" : [parseInt(dt[i].giatri)],
    			"text": dt[i].sp_ten,
    		};

        result += "<tr>"+
            "<td class='text-center'>"+ (i+1) +"</td>"+
            "<td class='text-center'>"+ dt[i].sp_ten +"</td>"+
            "<td class='text-center'>"+ dt[i].giatri +"</td>"+
            "</tr>";

        chartData.push(test);
    }
    $("#noiDung").html(result);

    var myConfig = {
    	type: "pie",
    	globals:{
    		fontFamily: 'sans-serif'
    	},
    	legend:{
    		verticalAlign: 'middle',
    		toggleAction: 'remove',
    		marginRight: 60,
    		width: 100,
    		alpha: 0.1,
    		borderWidth: 0,
    		highlightPlot: true,
    		item:{
    			fontColor: "#373a3c",
    			fontSize: 12
    		}
    	},
    	backgroundColor: "#fff",
    	palette:["#0099CC","#007E33","#FF8800","#CC0000","#33b5e5","#00C851","#ffbb33","#ff4444"],
    	plot:{
    		refAngle: 270,
    		detach: false,
    		valueBox:{
    			fontColor: "#fff"
    		},
    		highlightState:{
    			borderWidth: 2,
    			borderColor: "#000"
    		}
    	},
    	tooltip:{
    		text:'<span >%t</span><br><span >SL: %v</span>',
    		placement: 'node:out',
    		borderColor:"#373a3c",
    		borderWidth: 2
    	},
    	labels:[
	    	{
	    		fontSize: 26,
	    		textAlign: "center",
	    		fontColor : "#1E5D9E",
	    	}
    	],
    	series: chartData

    };

    zingchart.render({ 
    	id : 'myChart', 
    	data : myConfig, 
    	height: 500, 
    	width: 725 
    });


    zingchart.node_click = function (p) {

    	var SHIFT_ACTIVE = p.ev.shiftKey;
    	var sliceData = mySeries[p.plotindex];
    	isOpen = (sliceData.hasOwnProperty('offset-r')) ? (sliceData['offset-r'] !== 0) : false;
    	if(isOpen){
    		sliceData['offset-r'] = 0;
    	}
    	else{
    		if(!SHIFT_ACTIVE){
    			for(var i = 0 ; i< mySeries.length; i++){
    				mySeries[i]['offset-r'] = 0;
    			}
    		}
    		sliceData['offset-r'] = 20;
    	}

    	zingchart.exec('myChart', 'setdata',{
    		data : myConfig
    	});
    }
    
  });
});