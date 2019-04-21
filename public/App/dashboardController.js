function laySoLieu(link, id){
	$.ajax({
		url: link,
		type: "GET",
		headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	}).done(function(res){
		$(id).html(res.message)
	});
}
$(document).ready(function() {
	var urlChart = URL_2 + "admin/donhang/orderMonth";
	laySoLieu( URL_2 +"admin/donhang/getTotal", '#pSLDH');
	laySoLieu(URL_2 +"admin/khachhang/getTotal", '#pSLKH');
	// laySoLieu("http://localhost/Shop/public/admin/totalProduct", '#pSLSP');

	// setInterval(function(){
	//     laySoLieu("http://localhost/Shop/public/admin/totalCustomer", '#pSLKH');
	// 	laySoLieu("http://localhost/Shop/public/admin/totalOrderUnCheck", '#pSLDH');
	// 	laySoLieu("http://localhost/Shop/public/admin/totalProduct", '#pSLSP');
	// }, 20000);


	 $.ajax({
	    url: urlChart,
	    type: "GET",
	    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	  }).done(function(res){
	      var dt = res.message.duLieuThongKe;
	      var luu = 0;
	    
	      chartData = [];
	      chartUnit = [];
	      for(i=0; i<=dt.length-1; i++) {
	        if (dt[i].nam == 0) {
	          luu = parseInt(dt[i].giatri);
	        } else {
	          chartUnit.push(dt[i].nam +'-'+(dt[i].thang<10? ('0'+dt[i].thang): dt[i].thang));
	          chartData.push(parseInt(dt[i].giatri));
	        }
	      }
	      chartData[chartData.length-1] += luu;

	      chartConfig = {
	        "type": "area",
	        "plotarea": { "margin": "dynamic 45 60 dynamic" },
	        "scale-x": {
	          "labels": chartUnit
	        },
	        "scale-y": {
	          //"values": "1000000:6000000:1000000",
	          "line-color": "#7E7E7E",
	          "shadow": 0,
	          "guide": { "line-style": "dashed" },
	          "label": { "text": "Doanh thu (VNĐ)", },
	          "minor-ticks": 0,
	          "thousands-separator": ","
	        },
	        "crosshair-x": {
	          "line-color": "#efefef",
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
	        "tooltip": { "visible": false },
	        "plot": {
	          "highlight":true,
	          "background-color":"#E71640",
	          "animation":{
	            "effect":1,
	            "sequence":2,
	            "speed":100,
	          }
	        },
	        "series": [
	          {
	            "values": chartData,
	            "text": "Doanh thu",
	            // "legend-item":{
	            //   "background-color": "#007790",
	            //   "borderRadius":5,
	            //   "font-color":"white"
	            // },
	            "line-color": "#da534d",
                    "legend-item":{
                      "background-color": "#da534d",
                      "borderRadius":5,
                      "font-color":"white"
                    },
                    "legend-marker": {
                        "visible":false
                    },
                    "marker": {
                        "background-color": "#da534d",
                        "border-width": 1,
                        "shadow": 0,
                        "border-color": "#faa39f"
                    },
                    "highlight-marker":{
                      "size":6,
                      "background-color": "#da534d",
                    }
	          }
	        ]
	      };

	      zingchart.render({
	        id: "chTKT",
	        data: chartConfig,
	        height: 300,
	        width: '100%'
	      });
	  });
});