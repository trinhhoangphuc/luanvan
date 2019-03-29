$(document).ready(function() {
	var urlChart = URL_2 + "admin/thongke/orderYeah";
  var chartConfig = null;
  var chartData = [];
  var chartUnit = [];
  var chartList = [];

  var srcData = [];
  var srcUnit = [];
  var chartTime = "";

  $(".dropdown-menu").on('click', 'li a', function(){
    $(".btn-tk:first-child").html('Dữ liệu thống kê ' + $(this).text().toLowerCase() + ' <span class="caret"></span>');
    xuLyDuLieu($(this).text().toLowerCase());
    capNhatChart($(this).text().toLowerCase());
  });

  function xuLyDuLieu(value) {
    tieuDe = value;
    if (!isNaN(value)) {
      tieuDe = "Năm " + value;
    }
    tieuDe = " # " + tieuDe;
    $("#duLieuThoiGian").html(tieuDe);

      chartData = [];
      chartUnit = [];
      for (var i = 0; i < srcUnit.length; i++) {
        if (srcUnit[i].startsWith(value)) {
          chartData.push(srcData[i]);
          chartUnit.push(srcUnit[i]);
        }
      }
  
  }

  function capNhatChart(nam) {
    mau = "rgb(" +Math.floor(Math.random() * 255)+ "," +Math.floor(Math.random() * 255)+ "," +Math.floor(Math.random() * 255)+")";
    var chartConfig = {
    	"graphset": [
    	{
    		"type": "bar",
    		"background-color": "white",
    		"title": {
    			"text": "Thống kê doanh thu theo năm # Năm" + nam,
    			"font-color": "#7E7E7E",
    			"backgroundColor": "none",
    			"font-size": "22px",
    			"alpha": 1,
    			"adjust-layout":true,
    		},
    		"plotarea": {
    			"margin": "dynamic"
    		},
    		"legend": {
    			"layout": "x3",
    			"overflow": "page",
    			"alpha": 0.05,
    			"shadow": false,
    			"align":"center",
    			"adjust-layout":true,
    			"marker": {
    				"type": "circle",
    				"border-color": "none",
    				"size": "10px"
    			},
    			"border-width": 0,
    			"maxItems": 3,
    			"toggle-action": "hide",
    			"pageOn": {
    				"backgroundColor": "#000",
    				"size": "10px",
    				"alpha": 0.65
    			},
    			"pageOff": {
    				"backgroundColor": "#7E7E7E",
    				"size": "10px",
    				"alpha": 0.65
    			},
    			"pageStatus": {
    				"color": "black"
    			}
    		},
    		"plot": {
    			"aspect":"spline",
    			"highlight":true,
    			"tooltip-text": "%t views: %v",
    			"shadow": 0,
    			"line-width": "2px",
    			"marker": {
    				"type": "circle",
    				"size": 3
    			},
    			"highlight-state": { "line-width":3 },
    			// "animation":{
    			// 	"effect":1,
    			// 	"sequence":3,
    			// 	"speed":100,
    			// }
    			"animation":{
    				"effect":"11",
    				"method":"3",
    				"sequence":"ANIMATION_BY_PLOT_AND_NODE",
    				"speed":10
    			}
    		},
    		"scale-y": {
    			"line-color": "#7E7E7E",
    			"guide": {
    				"visible": true,
    				"line-style": "dashed"
    			},
    			"label": {
    				"text": "Doanh thu (VNĐ)",
    				"font-family": "arial",
    				"bold": true,
    				"font-size": "14px",
    				"font-color": "#7E7E7E",
    			},
    			"thousands-separator": ","
    		},
    		"scale-x": {
    			"labels": chartUnit
    		},
    		"tooltip": {
    			"visible": false
    		},
    		// "crosshair-x":{
    		// 	"line-width":"100%",
    		// 	"alpha":0.18,
    		// 	// "plot-label":{
    		// 	// 	"header-text":"%kv Sales"
    		// 	// }
    		// },
    		"crosshair-x": {
	          "line-width":"100%",
	          "alpha":0.18,
	          "plot-label": {
	            "border-radius": "5px",
	            "border-width": "1px",
	            "border-color": "#f6f7f8",
	            "padding": "10px",
	            "font-weight": "bold",
	            "thousands-separator": ","
	          },
	          "scale-label": {
	            "font-color": "#000",
	            "background-color": "#f6f7f8",
	            "border-radius": "5px"
	          }
	        },
    		"series": [
    		{
    			"values": chartData,
          		"text": nam,
    			"borderRadiusTopLeft": 7,
    			"alpha": 0.95,
    			"background-color": mau,
    		}
    		]
    	}
    	]
    };
    zingchart.render({
      id: "chTKT",
      data: chartConfig,
      height: 400,
      width: '100%'
    });
  }

  $.ajax({
    url: urlChart,
    type: "GET",
    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  }).done(function(res){
    var dt = res.message.duLieuThongKe;
  
    srcData = [];
    srcUnit = [];
    for(i=0; i<=dt.length-1; i++) {
      if (dt[i].nam != 0) {
        srcData.push(parseInt(dt[i].giatri));
        srcUnit.push(dt[i].nam +'-'+(dt[i].thang<10? ('0'+dt[i].thang): dt[i].thang));
        if (chartList.indexOf(dt[i].nam)==-1) {
          chartList.push(dt[i].nam);
          chartTime = dt[i].nam;
        }
      }
    }

    cmbTxt = "";
    for(i=0; i<=chartList.length-1; i++) {
      cmbTxt += '<li><a href="#" data-value="'+chartList[i]+'">'+chartList[i]+'</a></li>';
    }

    $("#cmbTKT .dm-2").html(cmbTxt);
    $("#cmbTKT .btn-tk:first-child").html('Dữ liệu thống kê ' + chartTime + ' <span class="caret"></span>');

    xuLyDuLieu(chartTime);
    capNhatChart(chartTime);
  });
});