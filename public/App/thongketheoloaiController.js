

$(document).ready(function() {
  var urlChart = URL_2 + "admin/thongke/orderLoai";

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
        mau = "rgb(" +Math.floor(Math.random() * 255)+ "," +Math.floor(Math.random() * 255)+ "," +Math.floor(Math.random() * 255)+")";
        
        var test = {
          "text": dt[i].l_ten,
          "values" : [parseInt(dt[i].giatri)],
          "lineColor": mau,
          "backgroundColor": mau,
          "lineWidth": 1,
          "marker": { backgroundColor: mau}
        }
       
        chartData.push(test);
    }


    var myConfig = {
      backgroundColor:'#FBFCFE',
      type: "ring",
      title: {
        text: "Loại sản phẩm bán chạy",
        fontFamily: 'Lato',
        fontSize: 26,

        padding: "15",
        fontColor : "#1E5D9E",
      },
      plot: {
        slice:'50%',
        borderWidth:0,
        backgroundColor:'#FBFCFE',
        animation:{
          "effect":"4",
          "sequence":"2",
        },
        valueBox: [
        {
          type: 'all',
          text: '%t',
          placement: 'out'
        }, 
        {
          type: 'all',
          text: '%npv%',
          placement: 'in'
        }
        ]
      },
      tooltip:{
        fontSize:16,
        anchor:'c',
        x:'50%',
        y:'50%',
        sticky:true,
        backgroundColor:'none',
        borderWidth:0,
        thousandsSeparator:',',
        text:'<span style="color:%color">%t</span><br><span style="color:%color">SL: %v</span>',
        mediaRules:[
        {
          maxWidth:500,
          y:'54%',
        }
        ]
      },
      plotarea: {
        backgroundColor: 'transparent',
        borderWidth: 0,
        borderRadius: "0 0 0 10",
        margin: "70 0 10 0"
      },
      legend : {
        toggleAction:'remove',
        backgroundColor:'#FBFCFE',
        borderWidth:0,
        adjustLayout:true,
        align:'center',
        verticalAlign:'bottom',
        marker: {
          type:'circle',
          cursor:'pointer',
          borderWidth:0,
          size:5
        },
        item: {
          fontColor: "#777",
          cursor:'pointer',
          offsetX:-6,
          fontSize:12
        },
        mediaRules:[
        {
          maxWidth:500,
          visible:false
        }
        ]
      },
      scaleR:{
        refAngle:270
      },
      series : chartData
    };

    zingchart.render({ 
      id : 'myChart', 
      data: {
        gui:{
          contextMenu:{
            button:{
              visible: true,
              lineColor: "#2D66A4",
              backgroundColor: "#2D66A4"
            },
            gear: {
              alpha: 1,
              backgroundColor: "#2D66A4"
            },
            position: "right",
            backgroundColor:"#306EAA", 
            item:{
              backgroundColor:"#306EAA",
              borderColor:"#306EAA",
              borderWidth: 0,
              fontFamily: "Lato",
              color:"#fff"
            }

          },
        },
        graphset: [myConfig]
      },
      height: '499', 
      width: '99%' 
    });
  });
});