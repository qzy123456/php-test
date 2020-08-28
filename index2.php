<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport"    content="width=device-width, initial-scale=1.0">
  <title>弹幕made by diligentyang</title>
  <style>
    body {
      font-family: "Microsoft YaHei" ! important;
      font-color:#222;
    }
    pre {
      line-height: 2em;
      font-family: "Microsoft YaHei" ! important;
    }
    h4 {
      line-height: 2em;
    }
    #danmuarea {
      position: relative;
      background: #222;
      width:800px;
      height: 445px;
      margin-left: auto;
      margin-right: auto;
    }
    .center {
      text-align: center;
    }
    .ctr {
      font-size: 1em;
      line-height: 2em;
    }
  </style>
  <script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
  <script src="../danmu/src/jquery.danmu.js"></script>
</head>

<body class="center">
Demo<br><br>
<!--黑背景和弹幕区-->
<div id="danmuarea">
  <div id="danmu" >
  </div>
</div>
<!--控制区-->
<div class="ctr" >
  <button type="button"  onclick="pauser()">弹幕暂停</button>  &nbsp;&nbsp;&nbsp;&nbsp;
  <button type="button"  onclick="resumer() ">弹幕继续</button>&nbsp;&nbsp;&nbsp;&nbsp;
  显示弹幕:<input type='checkbox' checked='checked' id='ishide' value='is' onchange='changehide()'> &nbsp;&nbsp;&nbsp;&nbsp;
  弹幕透明度:
  <input type="range" name="op" id="op" onchange="op()" value="100"> <br>
  当前弹幕运行时间(秒)：<span id="time"></span>&nbsp;&nbsp;
 设置当前弹幕时间(秒)： <input type="text" id="set_time" max=20 />
  <button type="button"  onclick="settime()">设置</button>
  <br>
  发弹幕:
  <select  name="color" id="color" >
    <option value="white">白色</option>
    <option value="red">红色</option>
    <option value="green">绿色</option>
    <option value="blue">蓝色</option>
    <option value="yellow">黄色</option>
  </select>
  <select name="size" id="text_size" >
    <option value="1">大文字</option>
    <option value="0">小文字</option>
  </select>
  <select name="position" id="position"   >
    <option value="0">滚动</option>
    <option value="1">顶端</option>
    <option value="2">底端</option>
  </select>
  <input type="textarea" id="text" max=300 />
  <button type="button"  onclick="send()">发送</button>
</div>
<script>
	//WebSocket
	var wsServer = 'ws://192.168.16.51:9505';
	var websocket= new WebSocket(wsServer);
	
	websocket.onopen = function (evt) {
		console.log("Connected to WebSocket server.");
		/*websocket.send("gaga");*/
		//连上之后就打开弹幕
		$('#danmu').danmu('danmuResume');
	};
	
	websocket.onclose = function (evt) {
		console.log("Disconnected");
	};
		
	websocket.onmessage = function (evt) {
		console.log('Retrieved data from server: ' + evt.data);
		var time = $('#danmu').data("nowTime")+1;
		var text_obj= evt.data +',"time":'+time+'}';//获取加上当前时间
		console.log(text_obj);
		var new_obj=eval('('+text_obj+')');
		$('#danmu').danmu("addDanmu",new_obj);//添加弹幕
	};
	
	websocket.onerror = function (evt, e) {
			console.log('Error occured: ' + evt.data);
	};



  //初始化
  $("#danmu").danmu({
    left:0,
    top:0,
    height:"100%",
    width:"100%",
    speed:5000,//弹幕速度，飞过区域的毫秒数
    opacity:1,
    default_font_color:"#CCCCCC", //弹幕默认字体颜色
    font_size_small:16,
    font_size_big:24,
    top_botton_danmu_time:6000
  });
    //一个定时器，监视弹幕时间并更新到页面上
  function timedCount(){
    $("#time").text($('#danmu').data("nowTime"));

    t=setTimeout("timedCount()",50)

  }
  timedCount();


  function starter(){
    $('#danmu').danmu('danmuStart');
  }
  function pauser(){
    $('#danmu').danmu('danmuPause');
  }
  function resumer(){
    $('#danmu').danmu('danmuResume');
  }
  function stoper(){
    $('#danmu').danmu('danmuStop');
  }
  function getime(){
    alert($('#danmu').data("nowTime"));
  }
  function getpaused(){
    alert($('#danmu').data("paused"));
  }
  
  //发送弹幕，使用了文档README.md第7节中推荐的方法
  function send(){
    var text = document.getElementById('text').value;
    var color = document.getElementById('color').value;
    var position = document.getElementById('position').value;
    //var time = $('#danmu').data("nowTime")+1;
    var size =document.getElementById('text_size').value;
    //var text_obj='{ "text":"'+text+'","color":"'+color+'","size":"'+size+'","position":"'+position+'","time":'+time+'}';
	//为了处理简单，方便后续加time，和isnew，就先酱紫发一半吧。
	//注：time为弹幕出来的时间，isnew为是否加边框，自己发的弹幕，常理上来说是有边框的。
    var text_obj='{ "text":"'+text+'","color":"'+color+'","size":"'+size+'","position":"'+position+'"';
	//利用websocket发送
	websocket.send(text_obj);
	//清空相应的内容
    document.getElementById('text').value='';
  }
  //调整透明度函数
  function op(){
    var op=document.getElementById('op').value;
    $('#danmu').danmu("setOpacity",op/100);
  }

  //调隐藏 显示
  function changehide() {
    var op = document.getElementById('op').value;
    op = op / 100;
    if (document.getElementById("ishide").checked) {
      $("#danmu").danmu("setOpacity",1)
    } else {
      $("#danmu").danmu("setOpacity",0)

    }
  }

  //设置弹幕时间
  function settime(){
    var t=document.getElementById("set_time").value;
    t=parseInt(t)
    $('#danmu').danmu("setTime",t);
  }
</script>

</body>
</html>