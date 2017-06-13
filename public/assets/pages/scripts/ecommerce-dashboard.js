var EcommerceDashboard=function() {
    function o(o, i, t, a) {
        $('<div id="tooltip" class="chart-tooltip">'+a.toFixed(2).replace(/(\d)(?=(\d {
            3
        }
        )+\.)/g, "$1,")+"USD</div>").css( {
            position: "absolute", display: "none", top: i-40, left: o-60, border: "0px solid #ccc", padding: "2px 6px", "background-color": "#fff"
        }
        ).appendTo("body").fadeIn(200)
    }
    var i=function() {
        var i=[["01/2013",
        4],
        ["02/2013",
        8],
        ["03/2013",
        10],
        ["04/2013",
        12],
        ["05/2013",
        2125],
        ["06/2013",
        324],
        ["07/2013",
        1223],
        ["08/2013",
        1365],
        ["09/2013",
        250],
        ["10/2013",
        999],
        ["11/2013",
        390]],
        t=($.plot($("#statistics_1"), [ {
            data:i, lines: {
                fill: .6, lineWidth: 0
            }
            , color:["#f89f9f"]
        }
        , {
            data:i, points: {
                show: !0, fill: !0, radius: 5, fillColor: "#f89f9f", lineWidth: 3
            }
            , color:"#fff", shadowSize:0
        }
        ], {
            xaxis: {
                tickLength:0, tickDecimals:0, mode:"categories", min:2, font: {
                    lineHeight: 15, style: "normal", variant: "small-caps", color: "#6F7B8A"
                }
            }
            , yaxis: {
                ticks:3, tickDecimals:0, tickColor:"#f0f0f0", font: {
                    lineHeight: 15, style: "normal", variant: "small-caps", color: "#6F7B8A"
                }
            }
            , grid: {
                backgroundColor: {
                    colors: ["#fff", "#fff"]
                }
                , borderWidth:1, borderColor:"#f0f0f0", margin:0, minBorderMargin:0, labelMargin:20, hoverable:!0, clickable:!0, mouseActiveRadius:6
            }
            , legend: {
                show: !1
            }
        }
        ), null);
        
			         
				 $("#statistics_1").bind("plothover", function(i, a, e) {
		            if($("#x").text(a.x.toFixed(2)), $("#y").text(a.y.toFixed(2)), e) {
		                if(t!=e.dataIndex) {
		                    t=e.dataIndex, $("#tooltip").remove();
		                    e.datapoint[0].toFixed(2), e.datapoint[1].toFixed(2);
		                    o(e.pageX, e.pageY, e.datapoint[0], e.datapoint[1])
		                }
		            }
		            else $("#tooltip").remove(), t=null
		        })
        
    }
    ,
    t=function() {
        var i=[["01/2013",
        10],
        ["02/2013",
        0],
        ["03/2013",
        10],
        ["04/2013",
        12],
        ["05/2013",
        212],
        ["06/2013",
        324],
        ["07/2013",
        122],
        ["08/2013",
        136],
        ["09/2013",
        250],
        ["10/2013",
        99],
        ["11/2013",
        190]],
        
        t=($.plot($("#statistics_2"), [ {
            data:i, lines: {
                fill: .6, lineWidth: 0
            }
            , color:["#BAD9F5"]
        }
        , {
            data:i, points: {
                show: !0, fill: !0, radius: 5, fillColor: "#BAD9F5", lineWidth: 3
            }
            , color:"#fff", shadowSize:0
        }
        ], {
            xaxis: {
                tickLength:0, tickDecimals:0, mode:"categories", min:2, font: {
                    lineHeight: 14, style: "normal", variant: "small-caps", color: "#6F7B8A"
                }
            }
            , yaxis: {
                ticks:3, tickDecimals:0, tickColor:"#f0f0f0", font: {
                    lineHeight: 14, style: "normal", variant: "small-caps", color: "#6F7B8A"
                }
            }
            , grid: {
                backgroundColor: {
                    colors: ["#fff", "#fff"]
                }
                , borderWidth:1, borderColor:"#f0f0f0", margin:0, minBorderMargin:0, labelMargin:20, hoverable:!0, clickable:!0, mouseActiveRadius:6
            }
            , legend: {
                show: !1
            }
        }
        ), null);
        
			        $("#statistics_2").bind("plothover", function(i, a, e) {
			            if($("#x").text(a.x.toFixed(2)), $("#y").text(a.y.toFixed(2)), e) {
			                if(t!=e.dataIndex) {
			                    t=e.dataIndex, $("#tooltip").remove();
			                    e.datapoint[0].toFixed(2), e.datapoint[1].toFixed(2);
			                    o(e.pageX, e.pageY, e.datapoint[0], e.datapoint[1])
			                }
			            }
			            else $("#tooltip").remove(), t=null
			        }
			        )
       
    }
    ;
 return {
        init:function() {
            i(),
            setInterval(function() {
            
                t()
            
            }, 500);

        }
    }
}

();
jQuery(document).ready(function() {
            if (!jQuery.plot) {
				EcommerceDashboard.init()
            }

}

);