<style type="text/css">
.schedule-list h1 {
  margin:5px 10px;
  font-size:16px;
}
.schedule-list li {
  display:block;
  background-color:#fff;
  border:1px solid #cdcdcd;
  margin:2px;
  font:15px Arial;
  color:#696969;
  padding:3px;
}
.schedule-list li:hover {
  background-color:#DFEEFF;
}
.schedule-list li a {
  float:left;
  padding:0 5px;
  width:65px;
  color:#3F97FF;
  text-decoration:none;
}
.schedule-list li label {
  float:left;
  width:100px;
  padding:0 10px 0 5px;
}
.schedule-list li strong {
  float:left;
  width:330px;
  padding:0 10px 0 5px;
  overflow:hidden;
}
.schedule-list li span{
  float:left;
  padding:0 10px 0 5px;
  width:170px;
  overflow:hidden;
}
</style>

  <div class="yui-d3">
    <div class="hd"></div>
    <div class="bd">
      <div class="yui-gf">
        <div class="yui-u first" style="border:1px solid gray;width:210px;height:500px;">
          <div class="hd"></div>
          <div class="bd">
            <div class="myicon"><img src="<?=getUserIcon('richardw', 150)?>" /></div>
            <h1>laudieh</h1>
          </div>
          <div class="ft"></div>
        </div>
        <div class="yui-u" style="width:750px;">
          <div class="hd"></div>
          <div class="bd">
            <div id="my-tab-all" class="yui-navset">
              <ul class="yui-nav">
                <li class="selected"><a href="#t1"><em>我的行程</em></a></li>
                <li><a href="#t2"><em>參考的行程</em></a></li>
                <li><a href="#t3"><em>跟團的行程</em></a></li>
                <li><a href="#t4"><em>帶團的行程</em></a></li>
              </ul>
              <div class="yui-content">
                <div id="t1" class="tabs">
                  <div class="hd"></div>
                  <div class="bd">
                    <ul>
                      <li id="history" class="schedule-list">
                        <h1 class="trigger row1 active"><a href="#">歷史行程</a></h1>
                        <ul class="sectiontext">
                          <li class="clearfix"><a href="#">第 91 天</a><label>2009-05-15(五)</label><strong>台北出發->成田機場</strong><span>GRAND HOTEL HYAAT</span></li>
                          <li class="clearfix"><a href="#">第 92 天</a><label>2009-05-16(六)</label><strong>品川->橫濱</strong><span>新大谷或同級</span></li>
                          <li class="clearfix"><a href="#">第 93 天</a><label>2009-05-17(日)</label><strong>橫濱->海濱幕張</strong><span>新宿華盛頓</span></li>
                          <li class="clearfix"><a href="#">第 94 天</a><label>2009-05-17(一)</label><strong>成田->台北</strong><span>溫暖的家</span></li>
                        </ul>
                      </li>
                      <li id="future" class="schedule-list">
                        <h1 class="trigger row2"><a href="#">預計行程</a></h1>
                        <ul class="sectiontext">
                          <li class="clearfix"><a href="#">第 91 天</a><label>2009-05-15(五)</label><strong>台北出發->成田機場</strong><span>GRAND HOTEL HYAAT</span></li>
                          <li class="clearfix"><a href="#">第 92 天</a><label>2009-05-16(六)</label><strong>品川->橫濱</strong><span>新大谷或同級</span></li>
                          <li class="clearfix"><a href="#">第 93 天</a><label>2009-05-17(日)</label><strong>橫濱->海濱幕張</strong><span>新宿華盛頓</span></li>
                          <li class="clearfix"><a href="#">第 94 天</a><label>2009-05-17(一)</label><strong>成田->台北</strong><span>溫暖的家</span></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                  <div class="ft"></div>
                </div>
                <div id="t2" class="tabs"></div>
                <div id="t3" class="tabs"></div>
                <div id="t4" class="tabs"></div>
              </div>
            </div>
            <script>
            (function() { var tabView = new YAHOO.widget.TabView('my-tab-all'); })();
            </script>
          </div>
          <div class="ft"></div>
        </div>
      </div>
    </div>
    <div class="ft"></div>
  </div>
<script type="text/javascript">
    $j(".sectiontext").hide(); 
    if($j("h1.trigger").hasClass("active")) {
      $j("h1.trigger").toggle(function(){
        $j(this).addClass("active");
        }, function () {
        $j(this).removeClass("active");
      });
    }
    else {
      $j("h1.trigger").toggle(function(){
        $j(this).removeClass("active");
        }, function() {
        $j(this).addClass("active");
      });
    }

    $j("h1.trigger").click(function(){
      $j(this).next(".sectiontext").slideToggle(500);
    });
    $j(".active").addClass("active").next(".sectiontext").slideToggle("fast");
    
</script>
